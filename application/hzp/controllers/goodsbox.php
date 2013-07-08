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
    
    //查询制定编码的商品库存数量
   // private function 
    
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
        //分页               
        $data = $this->fenye($id,'goodsin');        
        $this->header();
        $this->load->view('keepin',$data);
        $this->load->view('footer');        
    }
    
    
    //出库记录
    Public function keepOut($id = 0)
    {
        //分页                
            $data = $this->fenye($id,'goodsout');
            $idstr = $data['datalist']['id'];
            $this->load->model('goodsout_model');
            $goodsinfo = $this->goodsout_model->getGoodinfo($idstr);
            $data['goodsinfo'] = $goodsinfo;
            $data['wuliu'] = $this->goodsbox_model->wuliucompany();
            $this->header();
            $this->load->view('keepout',$data);
            $this->load->view('footer');
    }
    
    //商品出库（一键出库）
    Public function goodsOutBox($itme_code = 0)
    {
        if(!$itme_code)
        {
            $itme_code =  $this->input->post('itme_code');
        }
        //获取商品最近一次入库的价格
        $this->load->model('goodsin_model');
        $price = $this->goodsin_model->goodsPrice($itme_code);
        if($_POST)
        {            
            $post = $this->input->post();

            $data[0] = array(
                        'itme_code' => $post['itme_code'],
                        'quantity' => $post['quantity'],
                        'goods_name'=>$post['goods_name'],
                        'price' => $price['price'],
                        );
                        
            $wuliu = array(
                        'wusername' => $post['wusername'],
                        'phone' => $post['phone'],
                        'address' => $post['address'],
                        'wuliu_com' => $post['wuliu_com'],//客户要发的物流
                        'remarks' => $post['remarks'],
                        'userid' => $this->session->userdata('userid'),
                        'create_time' => time(),
                        'total' => $price['price'],       //总金额
                        'amount' => $post['amount'] ? $post['amount'] : $price['price'], //实收金额
                        );
            
            //出库数是否小于库存数据
            $quantity = $this->goodsbox_model->itmecode_Box($post['itme_code']);
            if($quantity < $post['quantity'])
            {
                $this->message_err($this->lang('gout_kuchunbuzhu'));//库存不足
            }
            
            if($this->goodsbox_model->goodsOutBox(array('data' =>$data,'wuliu' => $wuliu)))
            {
                $this->message_suc($this->lang('gbox_outbox_src'));//出库成功                  
                
            }else{
                
                $this->message_err($this->lang('gbox_outbox_err'));//出库失败
            }        
            
        }else{
            
            $this->header();
            $this->load->model('goods_model');
            $goodsinfo = $this->goods_model->getGoods($itme_code);            

            $data = array('itme_code' => $itme_code,'goods_name'=>$goodsinfo['goods_name'],'price'=>$price['price']);
            $data['wuliu'] = $this->goodsbox_model->wuliucompany();
            $this->load->view('goods_out',$data);
            $this->load->view('footer');            
        }                
    }
    
    //购物车商品出库
    Public function cartGoodsOutBox()
    {
        foreach($this->cart->contents() AS  $items)
        {
            $post = $this->input->post();
            $data[] = array(
                    'itme_code' => $items['id'],
                    'quantity' => $items['qty'],
                    'goods_name'=>$items['name'],
                    'price' => $items['price'],
                    );            
        }       
                    
        $wuliu = array(
                    'wusername' => $post['wusername'],
                    'phone' => $post['phone'],
                    'address' => $post['address'],
                    'wuliu_com' => $post['wuliu_com'],//客户要发的物流
                    'remarks' => $post['remarks'],
                    'userid' => $this->session->userdata('userid'),
                    'create_time' => time(),
                    'total' => $this->cart->total(),       //总金额
                    'amount' => $post['amount'] ? $post['amount'] : $this->cart->total(), //实收金额
                    );
                    
    //print_r($wuliu);die;
        
/*        //出库数是否小于库存数据
        $quantity = $this->goodsbox_model->itmecode_Box($post['itme_code']);
        if($quantity < $post['quantity'])
        {
            $this->message_err($this->lang('gout_kuchunbuzhu'));//库存不足
        }*/
        
        if($this->goodsbox_model->goodsOutBox(array('data' =>$data,'wuliu' => $wuliu)))
        {
            $this->cart->destroy();
            $this->message_suc($this->lang('gbox_outbox_src'));//出库成功                  
            
        }else{
            
            $this->message_err($this->lang('gbox_outbox_err'));//出库失败
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
    function wuliufahuo($id=0)
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
                $this->message_suc($this->lang('msg_insert_suc'));//添加成功
            }else{
                
                $this->message_err($this->lang('msg_insert_err'));//添加失败
            }               
            
        }else{
            
            //分页                
            $data = $this->fenye($id,'goodsout');
            $idstr = $data['datalist']['id']; 

            $this->load->model('goodsout_model');
            $goodsinfo = $this->goodsout_model->getGoodinfo($idstr);
            $data['goodsinfo'] = $goodsinfo;

            $data['wuliu'] = $this->goodsbox_model->wuliucompany();
            $this->header();
            $this->load->view('wuliufahuo',$data);
            $this->load->view('footer');
            
        }        
    }
    
    //取消出库 要把出库的商品数量加回去
    function cancelOutBox($wl_id)
    {
        $goods = $this->goodsbox_model->wuliu_GoodsOut($wl_id);
        //print_r($goods);die;
        //开始数据库的事务      
        $this->db->trans_begin();
        $this->goodsbox_model->updateWuliuStatus($wl_id);
        foreach($goods AS $garr)
        {
            $this->goodsbox_model->updateBox($garr);            
        }
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->message('取消失败','error');
        }
        else
        {
            $this->db->trans_commit();
            $this->message('取消成功');
        }
    }
    
    //购物车
    function cart($code = 0)
    {
        $this->load->library('cart');
        
        if(!$code = $this->input->get('code'))
        {
            $code = $this->input->post('code');
        }
        
        $itme_code = $this->input->post('itme_code');
        
        if($code == 'addCart') //添加到购物车
        {
            $this->addCart($itme_code);
            
        }elseif($code == 'delCartGoods'){
            
            $data = array(
               'rowid' => $this->input->get('rowid'),
               'qty'   => 0
            );

            $this->cart->update($data);
            header('Location:'.site_url('goodsbox/cart'));
            
        }elseif($code == 'updateCart')
        {
            $data = $this->input->post();
            unset($data['code']);

            if($this->cart->update($data))
            {
                $this->message_suc($this->lang('msg_update_suc'));//更新成功
            }else{
                
                $this->message_err($this->lang('msg_update_err'));//更新失败
            }
            
        }elseif($code == 'subOrder') //显示提交订单页面
        {
            $data['wuliu'] = $this->goodsbox_model->wuliucompany();
            $data['source'] = 'cart'; //前台台判断来源
            $this->header();
            $this->load->view('goods_out',$data);
            $this->footer();
            
        }elseif($code == 'cartGoodsOutBox'){ //购物车的数据提交到出库表
            
            $this->cartGoodsOutBox();
            
        }else{ //显示购物车
            
            $this->header();
            $this->load->view('cart');
            $this->footer();            
        }        
    }
    
    //添加到购物车
    function addCart($itme_code)
    {
        $this->load->model('goods_model');
        $goodsinfo = $this->goods_model->getGoods($itme_code);
        
        //获取商品最近一次入库的价格
        $this->load->model('goodsin_model');
        $price = $this->goodsin_model->goodsPrice($itme_code);
        
        $data = array(
               'id'      => $goodsinfo['itme_code'],
               'qty'     => 1, //数量默认为1
               'price'   => $price['price'],
               'name'    => $goodsinfo['goods_name'],
               'options' => array('capacity' => $goodsinfo['capacity'])
            );        
        
        if($this->cart->insert($data))
        {
            $this->message_suc($this->lang('msg_insert_suc'));//添加成功
        }else{
            
            $this->message_err($this->lang('msg_insert_err'));//添加失败
        }      
    }
    
    
}

/* End of file GoodsBox.php */
/* Location: ./application/controllers/GoodsBox.php */