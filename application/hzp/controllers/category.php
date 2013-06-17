<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {    

    var $menu;
    //var $table = 'category';
    var $son_menu;
    
    public function __construct()
    {
        parent::__construct();        
        //检测是否登录
        $this->is_login();
        $this->getMenu(BRAND); 
        $this->load->model($this->uri->rsegment(1).'_model');
    }

	public function index()
	{
	    header('Location:'.site_url().'/category/viewCategory');   	    
	}
    
    //查看分类
    function viewCategory()
    {
        $this->header();
        $datalist = $this->getDatalist();
        $datalist[0][0]['checked'] = 1;       
        
        $data = array(
        
            'datalist' => $datalist, 
            'pages' => $pages,
            'catname' => $cat_name,
        
        );
        
        $datas = &$data;
        
        //取得页内权限
        $this->page_purview($datas,BRAND,'updateCategory'); 
        //print_R($datalist);
        $this->load->view('category',$data);
        $this->load->view('footer');        
    }
    
    //更新分类
    function updateCategory($id = 0)
    { 
        $this->header();
        $dataArray['cat'] = $this->getCategory();    
                
        if($id)
        {
            $dataArray['cate'] = $this->getData($id);            
            $this->load->view('category_form',$dataArray);
                               
        }else{
            
            $this->load->view('category_form',$dataArray);            
        }
        
        $this->load->view('footer');    
        
    }
    
    //添加，更新
    public function update_category()
    {
        $post = $this->input->post();
        $data = array(
        
                   'parent_id'   => $post['parent_id'] ,
                   'keywords'    => $post['keywords'],
                   'sort_order'  => $post['sort_order'],
                   'is_show'     => $post['is_show'] == 'on' ? 0 : 1,                   
                );
         
        //验证是否重复
        if($this->verifyCatKeywords($data['keywords']))
        {            
            //更新
            if($post['cat_id'])
            {            
                if($this->category_model->updateCategory($data,$post['cat_id']))
                {
                    $this->message_suc($this->lang('msg_update_suc'));//修改成功
                
                }else{
                    
                    $this->message_err($this->lang('msg_update_err'));//修改失败
                } 
                
            }else{
                
                //添加
                if($this->category_model->insertCategory($data))
                {
                    $this->message_suc($this->lang('msg_insert_suc'));//添加成功
                                      
                }else{
                    
                    $this->message_err($this->lang('msg_insert_err'));//添加失败                    
                }                                         
            }            
        }
    }
    
    //验证keywords是否重复
    public function verifyCatKeywords($keywords)
    {
        if(!$this->category_model->verifyCatKeywords($keywords))
        {
             $this->message_err($this->lang('cate_key_choufu'));//重复
        }
        return TRUE;                
    }
    
    
    //获取数据
    public function getDatalist()
    {
         return $this->category_model->getDatalist();             
    }
    
    //获取指定id的数据
    Public function getData($id)
    {
        return $this->category_model->getData($id);
    }
    
    
    /**
     * 默认获取分类名称 $pid=0
     * $pid为关键字的父id,如果指定$pid,则函数反回指定分类下的所有关键字
     */
    function getCategory($pid = 0)
    {
        return $this->category_model->getCategory($pid = 0);        
    }  
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */