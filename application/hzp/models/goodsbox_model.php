<?php 
class Goodsbox_model extends CI_Model {
    
    var $table = 'goods_box';
    var $id = 'box_id';
    var $itmecode = 'itme_code';

    function __construct()
    {
        parent::__construct();
    }    
    
    //入库
    function goodsInBox($arr)
    {
        $itme_code = $arr['itme_code'];
        
        //开始数据库的事务      
        $this->db->trans_begin();

        //插入到入库表中
        $this->db->insert('goods_in', $arr);
        
        //更新商品库中的商品总量
        $this->db->set('quantity', 'quantity+'.$arr['quantity'],FALSE);
        $this->db->set('createtime',time());
        $this->db->where($this->itmecode,$itme_code);        
        $this->db->update($this->table);
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
        
    }
    
    //出库
    function goodsOutBox($arr)
    {
        //开始数据库的事务      
        $this->db->trans_begin();

        //插入到商品物流信息表中
        $this->db->insert('goods_wuliu', $arr['wuliu']);        
        $wlid = $this->db->insert_id();//物流表ID
        
        foreach($arr['data'] as $goodsout)
        {
            $goodsout['wl_id'] = $wlid;
            $this->db->insert('goods_out', $goodsout);
            
            //更新商品库中的商品总量
            $this->db->set('quantity', 'quantity-'.$goodsout['quantity'],FALSE);
            $this->db->set('createtime',time());
            $this->db->where($this->itmecode,$goodsout['itme_code']);        
            $this->db->update($this->table);
        }         
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }        
    }

    //查询商品库中有没有指定(商品编码)的记录
    //如果没有就进行初始化（总数量）为0
    Public function box_itmecode($itme_code)
    {
        $this->db->select('*')->from($this->table)->where($this->itmecode, $itme_code);
        $query = $this->db->get();
        
        if(!$query->num_rows())
        {
            //进行初始化数据
            $arrData = array(
                            'itme_code' => $itme_code,
                            'quantity'  => 0,
                            'createtime' => time(),  );
                            
            $this->db->insert($this->table, $arrData);
            return $this->db->insert_id();
        }
        return true;
    }
    
    //查询当前库存
    public function goodsBox()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('goods as gs','gs.itme_code ='.$this->table.'.itme_code','right');
        $this->db->order_by($this->id,'desc');
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        return $data;        
    }
    
    //查询制定商品编码的当前库存
    public function itmecode_Box($code)
    {
        $this->db->select('quantity')->from($this->table)->where('itme_code',$code);
        $query = $this->db->get();  
        $data = $query->row_array();
        return $data['quantity'];        
    }
    
    //返回物流公司的名称
    function wuliucompany()
    {
        //查找缓存
        $this->load->driver('cache');        
        if(!$data = $this->cache->file->get('wuliucompany'))
        {
            $this->db->select('wlname')->from('wuliucompany');
            $query = $this->db->get();
         
            foreach ($query->result_array() as $row)
            {
                $data[] =   $row;
            }
            $this->cache->file->save('wuliucompany', $data,900);
        }
        
        return $data;          
    }
    
    //添加物流公司及订单号
    function addOrderNum($data,$id)
    {
        $this->db->where('wl_id',$id);
        $this->db->update('goods_wuliu', $data);
        return $this->db->affected_rows();
    }
    
    //取消出库操作  通过物流wl_id 获取出库订单中的商品（编码、数量）
    public function wuliu_GoodsOut($id)
    {
        $str = "itme_code,quantity";
        $this->db->select($str)->from('goods_out')->where('wl_id',$id);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {            
            $data[] =   $row;           
        }
        return $data;         
    }
    
    //更新库存
   function updateBox($arr)
   {        
    //更新商品库中的商品总量
    $this->db->set('quantity', 'quantity+'.$arr['quantity'],FALSE);
    $this->db->where($this->itmecode,$arr['itme_code']);        
    $this->db->update($this->table);
   }
   
   //取消订单（出库） status 位置1，默认为0
   function updateWuliuStatus($wlid)
   {        
    //更新商品库中的商品总量
    $this->db->set('status', '1');
    $this->db->where('wl_id',$wlid);        
    $this->db->update('goods_wuliu');
   }
    
    
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */