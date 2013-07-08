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
        $this->load->model($this->uri->rsegment(1).'_model','model');
    }


	public function index()
	{
	   //print_r($_POST);die;
	    
	}
    
    //分类联动
    function ajaxCategory()
    {
       $post = $this->input->post();
       $this->load->driver('cache'); 
       if('base_cate' == $post['name'])
       {
        //查找缓存               
        if(!$base_cate = $this->cache->file->get('base_cate_'.$post['value']))
        {
            $base_cate = $this->model->baseCategory($post['value']);
            $this->cache->file->save('base_cate_'.$post['value'],$base_cate,900);            
        }
        $this->selectCategory($base_cate);
        
       }elseif('categor' == $post['name']){
        
        //查找缓存               
        if(!$categor = $this->cache->file->get('categor_'.$post['value']))
        {
            $categor = $this->model->getCategory($post['value']);
            $this->cache->file->save('categor_'.$post['value'], $categor,900);            
        }
        $this->selectCategory($categor);
                    
       }elseif('category' == $post['name']){
        
            //查找缓存               
            if(!$categor = $this->cache->file->get('categor_'.$post['value']))
            {
                $categor = $this->model->getCategory($post['value']);
                $this->cache->file->save('categor_'.$post['value'], $categor,900);            
            }
            $this->tableCategoroy($categor);        
       }
    }
    
    //输出select option
    function selectCategory($cat)
    {
        foreach($cat as $c)
        {
            $cat_str .= "<option value='{$c['bid']}'>{$c['cate_name']}</option>";
        }
        echo $cat_str;        
    }
    
    //输出表格
    function tableCategoroy($cat)
    {
        foreach($cat as $c)
        {
            $cattab .= "<tr><td>{$c['bid']}</td><td>{$c['cate_name']}</td><td><a class='btn' href='".site_url("brand/updateBrand/{$d['brand_id']}")."'><i class='icon-pencil'></i></a></td></tr>";
        }
        echo $cattab;       
    }
    
    //查看分类
    function viewCategory()
    {
        $this->header();        
        //获取总分类(基础分类)
        $base_cate = $this->model->baseCategory();
        $data = array('base_cate' => $base_cate);        
        //$datas = &$data;        
        //取得页内权限
        //$this->page_purview($datas,BRAND,'updateCategory'); 
        $this->load->view('category',$data);
        $this->load->view('footer');        
    }    
    
    //更新分类
    function updateCategory($id = 0)
    {   
        $this->header();        
        //获取总分类(基础分类)
        $base_cate = $this->model->baseCategory();
        $data = array('base_cate' => $base_cate);   
                
        if($id)
        {
            $dataArray['cate'] = $this->getData($id);            
            $this->load->view('category_form',$dataArray);
                               
        }else{
            
            $this->load->view('category_form',$data);            
        }
        
        $this->load->view('footer');    
        
    }
    
    //添加，更新
    public function update_category()
    {
        $post = $this->input->post();
        $data = array(
        
                   'parent_id'   => $post['category'] ,
                   'cate_name'    => $post['cate_name'],
                   'sort_order'  => $post['sort_order'],
                   'is_show'     => $post['is_show'] == 'on' ? 0 : 1,                   
                );
         
        //验证是否重复
        if($this->verifyCatKeywords($data['cate_name']))
        {            
            //更新
            if($post['cat_id'])
            {            
                if($this->model->updateCategory($data,$post['cat_id']))
                {
                    $this->message_suc($this->lang('msg_update_suc'));//修改成功
                
                }else{
                    
                    $this->message_err($this->lang('msg_update_err'));//修改失败
                } 
                
            }else{
                
                //添加
                if($this->model->insertCategory($data))
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
        if(!$this->model->verifyCatKeywords($keywords))
        {
             $this->message_err($this->lang('cate_key_choufu'));//重复
        }
        return TRUE;                
    }
    
    
    //获取数据
    public function getDatalist()
    {
         return $catelist = $this->model->getDatalist();             
    }
    
    //获取指定id的数据
    Public function getData($id)
    {
        return $this->model->getData($id);
    }
    
    
    /**
     * 默认获取分类名称 $pid=0
     * $pid为关键字的父id,如果指定$pid,则函数反回指定分类下的所有关键字
     */
    function getCategory($pid = 0)
    {
        return $this->model->getCategory($pid = 0);        
    }  
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */