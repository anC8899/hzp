<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goods extends MY_Controller {
    
    var $menu;
    var $son_menu;
    
    public function __construct()
    {
        parent::__construct();        
        //是否登录
        $this->is_login();
        $this->getMenu(GOODS);
        $this->load->model($this->uri->rsegment(1).'_model');
    }
    
    /* private */
    
    /**
     * 反回$pid指定分类下的所有关键字
     */
    private function getCateKeywords($pid)
    {
        $this->load->model('category_model');
        return $this->category_model->getCategory($pid);
        
    }
    
    //验证商品编码是否重复
    private function verifyItmeCode($itemcode)
    {
        if(!$this->goods_model->verifyItmeCode($itemcode))
        {
            $this->message_err($this->lang('goods_itme_repeat'));  
            return FALSE;            
        }
        return TRUE;      
    }
    
    //获取单个商品数据
    private function getData($bid)
    {
        return $this->goods_model->getData($bid);
    }
    
    //获取所有品牌
    private function getBrand()
    {
        $this->load->model('brand_model');
        return $this->brand_model->getBrand();        
    }
    
    
    //获取分类名称
    private function getCategory()
    {
        $this->load->model('category_model');
        return $this->category_model->getCategory();
        
    }
    
    /* private */

	public function index()
	{        
	    header('Location:'.site_url().'/goods/viewGoods');   	    
	}
    
    function viewGoods($id = 0)
    {
        $this->header();            
        $data = $this->fenye($id);//分页
        
        $datas = &$data;
        //入库权限
        $this->page_purview($datas,GOODS,'goodsIn');
        //出库权限
        $this->page_purview($datas,GOODS,'goodsOutBox');   
        //添加、修改商品权限
        $this->page_purview($datas,GOODS,'updateGoods');
                       
        $this->load->view('goods',$data);
        $this->load->view('footer');
        
    }
    
    
    //添加、修改商品
    function updateGoods($itmecode = 0)
    {
        $this->header();
        $this->load->helper('form');
        //获取总分类(基础分类)
        $this->load->model('category_model');
        $base_cate = $this->category_model->baseCategory();
                
        $data = array(
                        'brand' => $this->getBrand(),
                        'base_cate' => $base_cate     
                    );        
        if($itmecode)
        {
            if(!$goodsinfo = $this->goods_model->getGoods($itmecode))
            {
               $this->message('商品有误！','error'); 
            }
            //获取分类和子分类
            $data['categor'] = $this->category_model->baseCategory($goodsinfo['bid']);
            $data['son_cate'] = $this->category_model->getCategory($goodsinfo['bcaid']);
            $data['goods'] = $goodsinfo;
            $this->load->view('goods_form',$data);
                               
        }else{
            
            $this->load->view('goods_form',$data);            
        }
        $this->load->view('footer');        
    }
    
    //添加、修改商品
    public function update_goods()
    {
        $post = $this->input->post();
        $data = array(        
                       'brand_id'   => $post['brand'] ,
                       'base_cate'   => $post['base_cate'],
                       'categor'   => $post['categor'],
                       'son_cate'   => $post['son_cate'],
                       'itme_code'      => $post['itme_code'],
                       'capacity'   => $post['capacity'],
                       'goods_name'   => $post['goods_name'],
                       'goods_desc'      => $post['goods_desc'],
                    );        

        if($post['goods_id'])
        {
            if($this->goods_model->updateBrand($data,$post['goods_id']))
            {
                $this->message_suc($this->lang('msg_update_suc'));//成功
                
            }else{
                    
                $this->message_err($this->lang('msg_update_err'));//失败                   
            } 
            
        }else{
            
            //验证商品编码是否重复
            if($this->verifyItmeCode($post['itme_code']))
            {            
                //添加数据
                if($this->goods_model->insertGoods($data))
                {
                    $this->message_suc($this->lang('msg_insert_suc'));//成功
                                      
                }else{
                    
                    $this->message_err($this->lang('msg_insert_err'));//失败                    
                }   
            }
        }
    }    
}

/* End of file Goods.php */
/* Location: ./application/controllers/Goods.php */