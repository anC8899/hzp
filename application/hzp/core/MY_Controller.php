<?php
define("BRAND",1); //商品管理
define("GOODS",2); //货物管理
define("USERS",3); //用户管理

define('PERPAGE',20);//分页每页显示的数

class MY_Controller extends CI_Controller {
    
    var $menu;
    var $son_menu;
    var $controller;    //控制器名称
    var $method;        // 方法名称

    function __construct()
    {
        parent::__construct();
        $this->load->library('message','','msg');
        $this->controller = $this->uri->rsegment(1);
        $this->method = $this->uri->rsegment(2);
    }
    
    //获取数据分布中用于limit
    private function getDatalist($id1,$id2)
    {
        return $this->model->getDatalist($id1,$id2);             
    }
    
    //获取数据总数
    private function data_count()
    {        
        return $this->model->data_count();        
    }
    
    //检查session中是否有用户登录信息，如果有说明用户已经登录，如果没有则跳转登陆
    Public function is_login()
    {
        if(!$this->session->userdata('username'))
        {
             header('Location:'.site_url().'/login');die;
        }
        return true;
    }
    
    //输出头
    public function header()
    {
        $this->load->view('header', array('menu'=>$this->menu,'son_menu'=>$this->son_menu));
    }
    
    //输出尾
    public function footer()
    {
         $this->load->view('footer');
    }
    
    /**
     * $msg是提示信息
     *
     * 默认是成功
     */
    public function message($msg='',$class)
    {
        ob_start();//打开缓冲区        
        $this->header();
        
        $data = array(
                        'menu'=>$this->menu,
                        'son_menu'=>$this->son_menu,
                        'message'=>$msg,
                        'class' =>$class, 
                    );
                    
        $this->load->view('message',$data);
        $this->footer();        
        ob_end_flush();//输出并关闭缓冲区
        die;           
    }
    
    //错误提示
    function message_err($msg)
    {
        $this->msg->message_error($msg);
    }
    
    //成功提示
    function message_suc($msg)
    {
        $this->msg->message_success($msg);       
    }
    
    //普通提示
    function message_info($msg)
    {
        $this->msg->message_info($msg);
    }
        
    //获取菜单导航
    public function getMenu($n)
    {
        //查找缓存
        $this->load->driver('cache');        
        if(!$menu = $this->cache->file->get('menu'))
        {
            //获取导航数据
            $menu = $this->menu_model->getMenu();            
            $this->cache->file->save('menu', $menu,900);
        }

        $menu[$n]['active'] = 'active';

        //获取当前方法名称，方法名称等于导航数据的关键字
        $method = $this->method; 
        
        if($method != 'index')
        {
            //为当前访问的方法添加选中状态，如果无此方法则为空
            if($menu[$n]['son'][$method])
            {
               $menu[$n]['son'][$method]['checked'] = 'checked';
               
            }else{
    
                $this->message('你访问的页面不存在','',1);
            } 
        }
        
        $this->menu = $menu;//总导航        
        $this->son_menu = $menu[$n]['son']; //子导航
    }
    

    /**
     * 分页方法
     * 如果指定模型（mode不为空） 则加载mode指定的模型，
     * 默认为加载控制器相同名称的模型
     */
    public function fenye($id,$mode=0)
    {  
        if($mode)
        {
            //加载mode指定的模型
            $this->load->model($mode.'_model','model'); 
                       
        }else{
            //默认为加载控制器相同名称的模型
            $this->load->model($this->controller.'_model','model');
        }
        $this->load->library('pagination');
        
        $config['base_url'] = site_url().'/'.$this->controller.'/'.$this->method.'/';
        $config['total_rows'] = $this->data_count();
        $config['per_page'] = PERPAGE;
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
                
        $this->pagination->initialize($config);
        
        if ($config['total_rows'] < $config['per_page'])
        {
            $id = 0;
        }
            
        $pages = $this->pagination->create_links();
        $pages .= '<a>共'.$this->data_count().'条</a>';
        
        $datalist = $this->getDatalist($id,$config['per_page']);
        
        $data = array(
                        'datalist' => $datalist, 
                        'pages' => $pages
                    );
      
        return $data;

    }
    
    /**
     * 每个页面内部的权限
     * 
     * 包括:
     * updateUser 是否有添加或修改的权限
     * delete 是否有删除的权限
     * activ_user 是否有启用停用 用户的权限
     * $method 保存的为权限关键字
     * 
     */
    function page_purview(&$data,$class,$method)
    {
        //查找缓存
        $this->load->driver('cache');        
        if(!$menu = $this->cache->file->get('menu'))
        {
            //获取导航数据
            $menu = $this->menu_model->getMenu();            
        }
        
        if(is_array($menu[$class]['son'][$method]))
        {
            $data[$method] = 1;
        }        
    }
    
    //获取语言中的信息
    function lang($msg)
    {
        return $this->lang->line($msg);
    }
}