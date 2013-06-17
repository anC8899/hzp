<?php 
class Usersgroup_model extends CI_Model {
    
    var $table = 'usergroup';
    var $id = 'groupid';

    function __construct()
    {
        parent::__construct();
    }
    
    //获取用户组数据
    Public function getData($bid)
    {
        $this->db->select('*')->from($this->table)->where($this->id, $bid);
        $query = $this->db->get();
        return $query->row_array();
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
    
    public function groupAll()
    {
        $this->db->select('*')->from($this->table)->order_by($this->id,'desc');
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
    
    //更新列表    
    Public function updates($data,$id)
    {
        $this->db->where($this->id,$id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();        
    } 
    
    //添加
//    Public function inserts($data)
//    {
//        $this->db->insert($this->table, $data);
//        return $this->db->insert_id();        
//    }
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */