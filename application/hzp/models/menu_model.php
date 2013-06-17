<?php 
class Menu_model extends CI_Model {
    
    var $table = 'menu';
    var $id = 'menu_id';

    function __construct()
    {
        parent::__construct();
    }

    function getMenu($m = 0)
    {        
        if(!$m)
        {
            //从SESSION中取出用户信息
            $username = $this->session->userdata('username');
            $password = $this->session->userdata('password');
            $user = $this->verifylogin($username,$password);
            $purview = json_decode($user['purview'],true);
            
            $str = 0;
            foreach((array)$purview as $k =>$pur)
            {
                $str .= ','.$k;
                
                foreach($pur as $v)
                {
                    $str .= ','.$v;
                }            
            }
            
            $menuid = explode(',',$str);
            unset($menuid[0]);
            $this->db->where_in($this->id,$menuid);
        }

        $this->db->select('*')->from($this->table)->order_by('sort_order','desc');
        $query = $this->db->get();
        
        foreach ($query->result_array() as $row)
        {
            if(!$row['f_id'])
            {
                
              $main[$row['menu_id']] =   $row;  
              
            }else{
 
                $son[$row['f_id']][$row['sort']] = $row;             
            }                        
        }
        
        foreach($main as $k => &$m)
        {
            $m['son'] = $son[$k];
        }
        
        return $main;
    }
    
        //验证账号和密码是否正确，登录
    public function verifylogin($username,$pass)
    {
        $data = array(
                        'username'=>$username,
                        'password'=>$pass,
                        'is_activ'=>1,
                    );
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('usergroup as up','group = up.groupid');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row_array();           
    }
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */