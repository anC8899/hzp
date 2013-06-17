<?php 
class Brand_model extends CI_Model {
    
    var $table = 'brand';
    var $id = 'brand_id';

    function __construct()
    {
        parent::__construct();
    }    
    
    //获取所有品牌
    Public function getBrand()
    {
        $this->db->select('*')->from($this->table)->order_by('brand_id','desc');
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        return $data;        
    }
    
    //获取单个品牌
    Public function getData($bid)
    {
        $this->db->select('*')->from($this->table)->where('brand_id', $bid);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function getDatalist($id1,$id2)
    {
        $this->db->select('*')->from($this->table)->order_by('brand_id','desc')->limit($id2,$id1);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        return $data;         
    }
    
    //获取总数
    public function data_count()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();        
    }
    
    //验证品牌名称是否重复
    public function verifyBrandname($brandname)
    {
        $this->db->select($this->id)->from($this->table)->where('brand_name', $brandname);
        $query = $this->db->get();
        
        if($query->num_rows())
        {
            return FALSE;            
        }
        return TRUE;                
    }
    
    //更新品牌列表    
    Public function updateBrand($data,$brand_id)
    {
        $this->db->where('brand_id',$brand_id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();        
    } 
    
    //添加新的品牌
    Public function insertBrand($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();        
    }
    
    
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */