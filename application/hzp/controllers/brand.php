<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends MY_Controller {    
    
    public function __construct()
    {
        parent::__construct();        

        $this->is_login();        
        //获取用户的导航菜单
        $this->getMenu(BRAND);
        $this->load->model($this->uri->rsegment(1).'_model');
    }

	public function index()
	{
       header('Location:'.site_url().'/brand/viewBrand');   
	}
    
    //查看
    function viewBrand($id = 0)
    {
        $this->header();                       
        $data = $this->fenye($id);//分页
        $datas = &$data;
        
        //查看是否有添加、修改的权限
        $this->page_purview($datas,BRAND,'updateBrand');       
        $this->load->view('brand',$data);        
        $this->footer();        
    }
    
    //添加、修改
    function updateBrand($id = 0)
    {
        $this->load->helper('form');
        $this->header();
        if($id)
        {
            $brand = $this->getData($id);
            $this->load->view('brand_form',array('brand'=>$brand));
                               
        }else{
            $this->load->view('brand_form');
            
        }        
       $this->footer();            
    }
    
    public function update_brand()
    {        
        $post = $this->input->post();

        //判断品牌名称是否为空
        if(strlen($post['brand_name_en']) < 1 && strlen($post['brand_name']) < 1)
        {
            //品牌名称不能为空！
            $this->message_err($this->lang('brand_name_not_null'));        
        }
        
        $data = array(        
                   'brand_name_en'=> $post['brand_name_en'] ? $post['brand_name_en'] : $post['brand_name'],
                   'brand_name'   => $post['brand_name'] ? $post['brand_name'] : $post['brand_name_en'],
                   'brand_desc'   => $post['brand_desc'],
                   'sort_order'   => $post['sort_order'],
                   'is_show'      => $post['is_show'] == 'on' ? 0 : 1,
                );        
            
        if($post['brandid'])
        {
            if($this->brand_model->updateBrand($data,$post['brandid']))
            {
                $this->message_suc($this->lang('msg_update_suc'));
                
            }else{
                
                $this->message_err($this->lang('msg_update_err'));
            } 
            
        }else{
            
            //验证品牌名称是否重复
            if($this->verifyBrandname($data['brand_name_en']))
            {                
                //添加数据
                if($this->brand_model->insertBrand($data))
                {
                    
                    $this->message_suc($this->lang('msg_insert_suc'));
                                      
                }else{
                    
                    $this->message_err($this->lang('msg_insert_err'));                    
                }                               
            }            
        }                
    }
    
    //验证品牌名称是否重复
    public function verifyBrandname($brandname)
    {
        if(!$this->brand_model->verifyBrandname($brandname))
        {
            $this->message_err($this->lang('brand_name_repeat'));  
        }
        return TRUE;                
    }
    
    //获取单个品牌
    Public function getData($bid)
    {
        return $this->brand_model->getData($bid);
    }
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */