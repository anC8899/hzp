<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $n = 1;
        $n = $this->input->get('n');
        $p = $this->input->get('per_page');      
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/sws/index/index?n='.$n;
         $config['page_query_string'] = true;
        $config['total_rows'] = $this->data_count();
        $config['per_page'] = 12;
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['cur_tag_open'] = '&nbsp;<span title="当前页面" class="current">';
        $config['cur_tag_close'] = '</span>';
        $this->pagination->initialize($config);
        if ($config['total_rows'] < $config['per_page'])
            $p = 0;
        $pages = $this->pagination->create_links();        
        $datalist = $this->viewdata($p,$config['per_page']);
        $this->load->view('sws/index',array('data'=>$datalist,'id'=>$n , 'pages' => $pages));
    }
       
    
    //活动介绍
    function hdjs()
    {        
        $this->load->view('sws/hdjs');
    }
    
    
    //点击量增加
    function votes()
    {
        $id = $this->input->get('n');
        $this->db->set('votes','votes+1',FALSE);
        $this->db->where('img_id', $id);
        $this->db->update('sws_uploadphoto'); 
    }
    
    //获取数据
    public function viewdata($id1,$id2)
    {
        $n = $this->input->get('n');
        if($n=='2')
        {
            $this->db->order_by('speed','asc');
            
        }elseif($n == '3')
        {
            $this->db->order_by('votes','desc');
            
        }else{
            
            $this->db->order_by('speed','desc');
            
        }
        $this->db->limit($id2,$id1);
        $query = $this->db->get('sws_uploadphoto'); 
               
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        return $data;              
    }
    
    //获取数据总数
    public function data_count()
    {
        $query = $this->db->get('sws_uploadphoto');
        return $query->num_rows();        
    }
}