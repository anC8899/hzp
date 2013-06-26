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
    public function keepIn($id = 0)
    {
        //分业                
        $data = $this->fenye($id,'goodsin');        
        $this->header();
        $this->load->view('keepin',$data);
        $this->load->view('footer');
        
    }
    
    
    //出库记录
    Public function keepOut($id = 0)
    {
        //分业                
        $data = $this->fenye($id,'goodsout');
        //print_r($data);        
        $this->header();
        $this->load->view('keepout',$data);
        $this->load->view('footer');
    }
    
    //商品出库
    Public function goodsOutBox($itme_code = 0)
    {
        if($_POST)
        {
            $post = $this->input->post();
            $data = array(
                        'itme_code' => $post['itme_code'],
                        'quantity' => $post['quantity'],
                        'userid' => $this->session->userdata('userid'),
                        'amount' => $post['amount'],
                        'createtime' => time());
                        
            $wuliu = array(
                        'wusername' => $post['wusername'],
                        'phone' => $post['phone'],
                        'address' => $post['address'],
                        'wuliu_company' => $post['wuliu_company'],
                        'remarks' => $post['remarks'],
                        );
            if($this->goodsbox_model->goodsOutBox(array('data' =>$data,'wuliu' => $wuliu)))
            {
                $this->message_suc($this->lang('gbox_outbox_src'));//出库成功                  
                
            }else{
                
                $this->message_err($this->lang('gbox_outbox_err'));//出库失败
            }        
            
        }else{
            
            $this->header();
            $data = array('itme_code' => $itme_code);
            $this->load->view('goods_out',$data);
            $this->load->view('footer');            
        }                
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
    
    
    //物流发货
    function wuliufahuo()
    {
        if($_POST)
        {
            $id = $this->input->post('wl_id');
            $data = array(
                    'wuliu_company'=>$this->input->post('wuname'),
                    'w_ordernumber'=>$this->input->post('w_ordernumber'),
                    'createtime' => time(),
            );
            if($this->goodsbox_model->addOrderNum($data,$id))
            {
                echo "成功";
            }else{
                
                echo "失败";
            }
               
            
        }else{
            
            //分业                
            $data = $this->fenye($id,'goodsout');
            $data['wuliu'] = $this->goodsbox_model->wuliucompany();
            $this->header();
            $this->load->view('wuliufahuo',$data);
            $this->load->view('footer');
            
        }
        
        
    }
}

/* End of file GoodsBox.php */
/* Location: ./application/controllers/GoodsBox.php */