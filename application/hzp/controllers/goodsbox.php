<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goodsbox extends MY_Controller {
    
    var $menu;
    var $son_menu;
    
    public function __construct()
    {
        parent::__construct();
        
        //用户是否登陆
        $this->is_login();
        
        //获取导航-菜单
        $this->getMenu(GOODS);        
        $this->load->model('goodsbox_model');
    }
    
    //通过商品编码获取商品
    Public function getGoods($itmecode)
    {
        $this->load->model('goods_model');
        return $this->goods_model->getGoods($itmecode);
        
    }

	public function index($id = 0)
	{
	}
    
    
    //入库操作
   	public function goodsIn($itme_code = 0)
	{
	   $dataArray['goods'] = $this->getGoods($itme_code);
	   $this->load->helper('form');
       $this->header();       
       $this->load->view('goods_in',$dataArray);
       $this->load->view('footer');
	}
    

    //商品入库
    Public function goodsInBox()
    {
        $post = $this->input->post();
        $dataArray = array(
                        'itme_code' => $post['itme_code'],
                        'price' => $post['price'],
                        'quantity' => $post['quantity'],
                        'userid' => $this->session->userdata('userid'),
                        'createtime' => time());                        
                        
        //查询商品库中有没有指定(商品编码)的记录
        //如果没有就进行初始化（总数量）为0
        if($this->goodsbox_model->box_itmecode($post['itme_code']))
        {
            
            if($this->goodsbox_model->goodsInBox($dataArray))
            {
                $this->message_suc($this->lang('gbox_inbox_src'));//入库成功                  
                
            }else{
                
                $this->message_err($this->lang('gbox_inbox_err'));//入库失败
            }
            
        }
                    

        //print_R($post);
        
    }
    
    //入库记录
    public function keepIn($id=0)
    {
        //分业                
        $data = $this->fenye($id,'goodsin');        
        $this->header();
        $this->load->view('keepin',$data);
        $this->load->view('footer');
        
    }
    
    
    //出库记录
    Public function keepOut()
    {
        
    }
    
    //商品出库
    Public function goodsOutBox()
    {
        
    }
    
    //商品库存
    public function goodsBox()
    {
        $this->header();            
        $datalist = $this->goodsbox_model->goodsBox();
        $data = array('datalist' => $datalist);          
        $this->load->view('goodsbox',$data);
        $this->load->view('footer');
        
    }   
}

/* End of file GoodsBox.php */
/* Location: ./application/controllers/GoodsBox.php */