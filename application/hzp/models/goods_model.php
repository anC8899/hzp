<?php 
class Goods_model extends CI_Model {
    
    var $table = 'goods';
    var $id = 'goods_id';

    function __construct()
    {
        parent::__construct();
    }
   
    
    //获取总数
    public function data_count()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();        
    }
    
    public function getDatalist($id1,$id2)
    {
        $this->db->select('*')->from($this->table)->order_by($this->id,'desc')->limit($id2,$id1);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        return $data;         
    }
    
    //获取单个商品数据
    Public function getData($bid)
    {
        $this->db->select('*')->from($this->table)->where($this->id, $bid);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    //通过商品编码获取单个商品数据
    Public function getGoods($itmecode)
    {
        $this->db->select('b.brand_name,b.brand_name_en,c.cat_name,cat.keywords,goods.itme_code,goods.capacity,goods.goods_name,goods.goods_desc');
        $this->db->from($this->table);
        $this->db->join('brand as b','b.brand_id = goods.brand_id');
        $this->db->join('category as c','c.cat_id = goods.cat_id');
        $this->db->join('category as cat','cat.cat_id = goods.keywords_id');
        $this->db->where('itme_code', $itmecode);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    //验证商品编码是否重复
    public function verifyItmeCode($itemcode)
    {
        $this->db->select('*')->from($this->table)->where('itme_code', $itemcode);
        $query = $this->db->get();
        
        if($query->num_rows())
        {
            return FALSE;            
        }
        return TRUE;                
    }
    
    //更新商品 
    Public function updateBrand($data,$id)
    {
        $this->db->where($this->id,$id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();        
    } 
    
    //添加新的商品
    Public function insertGoods($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();        
    }
    
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */