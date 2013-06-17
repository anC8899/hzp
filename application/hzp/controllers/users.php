<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {    
    
    public function __construct()
    {
        parent::__construct();
        $this->is_login();
        $this->getMenu(USERS);
        $this->load->model('users_model');
        $this->load->model('usersgroup_model');
    }
    
    /* private */
    
    private function verifyUsername($username)
    {
        if(!$this->users_model->verifyUsername($username))
        {
            $this->message_err($this->lang('user_name_repeat'));  
            return false;      
        }
        return TRUE;                
    }
    
    private function getData($bid)
    {
        return $this->users_model->getData($bid);
    }
    
    /* private */    

	public function index()
	{
       header('Location:'.site_url('users/viewUser'));   
	}
    
    //查看用户
    function viewUser($id = 0)
    {
        $this->header();                    
        $data = $this->fenye($id);
        $datas = &$data;
        
        $this->page_purview($datas,USERS,'updateUser');
        $this->page_purview($datas,USERS,'isActivUser'); 
        //print_r($data);      
        $this->load->view('users',$data);        
        $this->load->view('footer');
    }
    

    
    //修改添加用户
    function updateUser($id = 0)
    {
        $this->load->helper('form');
        $this->header();
        $group = $this->usersgroup_model->groupAll();
        $data = array('group'=>$group);
        if($id)
        {
            $user = $this->getData($id);
            $data['user'] = $user;
            $data['pagetitle'] = $this->lang('user_update_user');//修改用户            
            $this->load->view('users_form',$data);
                               
        }else{
            
            $data['pagetitle'] = $this->lang('user_insert_user');//添加用户
            $this->load->view('users_form',$data);
            
        }
        $this->load->view('footer');    
        
    }
    
    public function update_user()
    {
        $post = $this->input->post();
        
        if(!$post['userid'])
        {
            if(strlen($post['username']) < 1)
            {
               $this->message_err($this->lang('user_name_notnull'));//用户名称不能为空                 
            }
        }
        
        $data = array(
        
               'username'   => $post['username'],
               'password'   => md5($post['password'].md5($this->config->item('encryption_key'))),
               'uname'   => $post['uname'],
               'group'   => $post['group']
        );
            
        if($post['userid'])
        {
            unset($data['username']);
            if($this->users_model->updateUsers($data,$post['userid']))
            {
                $this->message_suc($this->lang('msg_update_suc'));//成功
                
            }else{
                    
                    $this->message_err($this->lang('msg_update_err'));//失败
            } 
            
        }else{

            if($this->verifyUsername($data['username']))
            {
                if($this->users_model->insertUsers($data))
                {
                    $this->message_suc($this->lang('msg_insert_suc'));//成功
                                      
                }else{
                    
                    $this->message_err($this->lang('msg_insert_err'));//失败                    
                }                               
            }            
        }                
    }
    
    //修改密码    
    Public function  updatePassoord()
    {
        if($pass = $this->input->post())
        {
            if($pass['password'] === $pass['password2'])
            {
                $password = md5($pass['password'].md5($this->config->item('encryption_key')));
                $data = array('password' => $password);
                if($this->users_model->updateUsers($data,$this->session->userdata('userid')))
                {
                    //修改session 中的密码
                    $this->session->set_userdata('password', $password);
                    $this->message_suc($this->lang('msg_update_suc'));//修改成功
                    
                }else{
                    
                    $this->message_err($this->lang('msg_update_err'));//修改失败
                } 
 
            }else{
                
                $this->message_err($this->lang('user_pass_err')); //二次密码不同
            }
            
        }else{
            
            $this->header();
            $user = array(
                          'username'    => $this->session->userdata('username'),
                          'uname'       => $this->session->userdata('uname'), );
                          
            $data = array('user' => $user,
                          'pagetitle' => $this->lang('user_update_password') );//修改密码
            $this->load->view('userspassword',$data);
            $this->load->view('footer');            
        }
        
         
        
    }
    
    /**
     * 启用或停用用户
     */
    Public function isActivUser()
    {
        $data = array('is_activ' => $this->input->get('activ') ? 0 : 1);

        if($this->users_model->updateUsers($data,$this->input->get('id')))
        {
            $this->message($this->lang('msg_update_suc'),'success');
            
        }else{
            
            $this->message($this->lang('msg_update_err'),'error');
        }
        
    }
    
    /**
     * 查看用户组
     */
    Public function usersGroup($id=0)
    {
        $this->header();          
        $data = $this->fenye($id,'usersgroup');
        $datas = &$data;
        
        $this->page_purview($datas,USERS,'usersGroupPurview');         
        $this->load->view('usersgroup',$data);        
        $this->load->view('footer');       
    }
    
    /**
     * 查看用户组权限
     */
    public function usersGroupPurview($id = 0)
    {
        $this->load->helper('form');
        $this->header();
        
        //获得所有权限
        $menulist = $this->Menu_model->getMenu(1);        
        $purview = $this->usersgroup_model->getData($id);
        $purview = json_decode($purview['purview'],true); 
        
        foreach($menulist as &$menu)
        {
            if(is_array($menu['son']))
            {
                foreach($menu['son'] as &$son)
                {
                    foreach((array)$purview[$son['f_id']] as $kp => $p)
                    {
                        if($son['menu_id'] == $p)
                        {
                            $son['check'] = 1;
                        }                    
                    }                
                }                
            }                        
        }    

        $data = array('menulist'=>$menulist,'id'=>$id);
        $this->load->view('usersgroup_form',$data);
        $this->footer();
    }
    
    //权限
    public function purview()
    {
        $id = $this->input->post('groupid');
        $purview = $this->input->post();

        unset($purview['groupid']);

        $data = array('purview' => json_encode($purview));
        
        //更新权限
        if($this->usersgroup_model->updates($data,$id))
        {
            $this->message_suc($this->lang('msg_update_suc'));//修改成功
            
        }else{

            $this->message_err($this->lang('msg_insert_err'));//修改失败    
        } 
    }

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */