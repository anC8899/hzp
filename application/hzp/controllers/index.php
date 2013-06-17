<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
    var $menu;
    
    public function __construct()
    {
        parent::__construct();
        
        //用户是否登陆
        $this->is_login();
        //$controller = $this->uri->rsegment(1);
        $this->menu = $this->Menu_model->getMenu();
    }
	public function index($id = 0)
	{
	   //print_R($_SERVER["HTTP_USER_AGENT"]);
       print_r($this->session->all_userdata());
       //echo md5($this->config->item('encryption_key'));
	   
       //print_r($data);
//	    $this->load->helper('form');
//        $this->load->library('pagination');
//        $config['base_url'] = base_url() . 'casoon.php/index/index/';
//        $config['total_rows'] = $this->data_count();
//        $config['per_page'] = 20;
//        $config['first_link'] = '首页';
//        $config['last_link'] = '尾页';
//        $config['prev_link'] = '上一页';
//        $config['next_link'] = '下一页';
//        $config['cur_tag_open'] = '<span title="当前页面" class="current">';
//        $config['cur_tag_close'] = '</span>';
//        $this->pagination->initialize($config);
//        if ($config['total_rows'] < $config['per_page'])
//            $id = 0;
//        $pages = $this->pagination->create_links();
//        
//        $datalist = $this->viewdata($id,$config['per_page']);
//        $data = array('datalist' => $datalist, 'pages' => $pages);

        $this->load->view('header', array('menu'=>$this->menu));
        $this->load->view('index', array('menu'=>$this->data));
        $this->load->view('footer');        
	}
    //获取数据
//    public function viewdata($id1,$id2)
//    {
//        $this->db->select('*')->from('applynow')->order_by('createtime','desc')->limit($id2,$id1);
//        $query = $this->db->get();        
//        foreach ($query->result_array() as $row)
//        {
//            $data[] =   $row;
//        }
//        return $data;              
//    }
    //获取数据总数
//    public function data_count()
//    {
//        $query = $this->db->get('applynow');
//        return $query->num_rows();        
//    }
    
    //查房数据
//    public function selectdata()
//    {
//        $this->load->helper('form');
//        
//        $data = $this->sel_data();
//        
//        $this->load->view('index',array('datalist' => $data));
//        
//    }
    //导出数据
    public function export()
    {
        $data = $this->sel_data();
        $this->load->view('export', array('datalist'=>$data));       
    }
    
    public function sel_data()
    {
        $start = strtotime($this->input->post('start'));
        $stop = strtotime($this->input->post('stop'));
        $where = "createtime >= {$start} and createtime <= {$stop}";
        $this->db->select('*')->from('applynow')->where($where)->order_by('createtime','desc');
        $query = $this->db->get();   
             
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        
        return $data;        
    }

}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */