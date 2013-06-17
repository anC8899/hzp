<?php 
class Goodsbox_model extends CI_Model {
    
    var $table = 'goods_box';
    var $id = 'box_id';
    var $itmecode = 'itme_code';

    function __construct()
    {
        parent::__construct();
    }
    
    function getMenu()
    {
    
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
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */