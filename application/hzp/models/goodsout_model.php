<?php 
class Goodsout_model extends CI_Model {
    
    var $table = 'goods_out';
    var $id = 'goodsout_id';
    //var $itmecode = 'itme_code';

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
        $str = "goodsout_id,itme_code,quantity,amount,{$this->table}.createtime,remarks,goods_wuliu.wl_id,username,uname,wusername,phone,address,wuliu_company,w_ordernumber";
        $this->db->select($str)->from($this->table);
        $this->db->join('user','user.userid ='.$this->table.'.userid','left');
        $this->db->join('goods_wuliu','goods_wuliu.wl_id ='.$this->table.'.wl_id');
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