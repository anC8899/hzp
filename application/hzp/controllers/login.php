<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();        
        $this->load->model('users_model');
    }
    
    //登陆
    public function index()
    {
        $this->session->userdata('username') && header('Location:'.site_url());
        
        if($applynow = $this->input->post(NULL,TRUE))
        {
            $user = $this->users_model->verifylogin($applynow['name'],$applynow['pass']);
            
            //print_R($user);

            if($user)
            {                
//                $data = array(
//                            'userid'        =>  $user['userid'],
//                            'username'      =>  $user['uname'],
//                            'purview'       =>  $user['purview'],                            
//                );
                
                $this->session->set_userdata($user);
                //print_r($this->session->all_userdata());
                header('Location:'.site_url());

            }else{
                
                $this->quit();
            }
            
        }else{
            
            $this->load->helper('form');  
            $this->load->view('login');            
        }
    }     

    //退出
    public function quit()
    {
        $this->session->sess_destroy();
        header('Location:'.site_url().'/index/login');
    }

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */