<?php 
class Goodsin_model extends CI_Model {
    
    var $table = 'goods_in';
    var $id = 'goodsin_id';
    //var $itmecode = 'itme_code';

    function __construct()
    {
        parent::__construct();
    }
    
    //入库记录
    function goodsInKeep()
    {
        
    }
    
    //获取总数
    public function data_count()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();        
    }
    
    public function getDatalist($id1,$id2)
    {
        $this->db->select('*')->from($this->table);
        $this->db->join('user','user.userid ='.$this->table.'.userid','left');
        $this->db->order_by($this->id,'desc')->limit($id2,$id1);
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