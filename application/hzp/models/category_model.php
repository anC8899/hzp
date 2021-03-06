<?php 
class Category_model extends CI_Model {
    
    var $basetable = 'base_cate';// 基础分类表   
    var $table = 'category';//分类表
    var $id = 'cat_id';
    var $pid = 'parent_id';

    function __construct()
    {
        parent::__construct();
    }
    
    //返回所有基础分类
    function baseCategory($fid = 0)
    {
        $this->db->select('*')->from($this->basetable)->where('fid',$fid);
        $query = $this->db->get();
               
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        
        return $data;
    }

    /**
     * 默认获取分类名称 $pid=0
     * $pid为关键字的父id,如果指定$pid,则函数反回指定分类下的所有关键字
     */
    function getCategory($pid = 0)
    {
        $this->db->select('cat_id as bid,cate_name')->from($this->table)->where($this->pid,$pid);
        $query = $this->db->get(); 
               
        foreach ($query->result_array() as $row)
        {
            $data[] =   $row;
        }
        
        return $data;        
    }
    
    public function verifyCatKeywords($cate_name)
    {
        $this->db->select('*')->from($this->table)->where('cate_name', $cate_name);
        $query = $this->db->get();
        
        if($query->num_rows())
        {
            return FALSE;            
        }
        return TRUE;                
    }
    
    public function data_count()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();        
    }
    
    //获取指定id的数据
    Public function getData($bid)
    {
        $this->db->select('*')->from($this->table)->where($this->id, $bid);
        $query = $this->db->get();
        return $query->row_array();
    }  

    
    //获取数据
    public function getDatalist()
    {
        $this->db->select('*')->from($this->table)->order_by('sort_order','desc');
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data[$row['parent_id']][] =   $row;
        }
        return $data;              
    }
    
    //更新分类
    Public function updateCategory($data,$id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();       
    }
    
    //添加分类数据
    Public function insertCategory($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();        
    }
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */