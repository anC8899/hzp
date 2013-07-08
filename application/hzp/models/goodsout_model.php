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
        $str = "uname,wl_id,wusername,phone,address,wuliu_com,wuliu_company,w_ordernumber,remarks,create_time,status,total,amount";
        $this->db->select($str)->from('goods_wuliu');
        $this->db->join('user','user.userid =goods_wuliu.userid','left');
        $this->db->order_by('wl_id','desc')->limit($id2,$id1);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data['id'][] = $row['wl_id'];
            $data[] =   $row;           
        }

        return $data;         
    }
    
    //获取商品
    public function getGoodinfo($idstr)
    {
        $str = "goodsout_id,itme_code,goods_name,quantity,price,wl_id";
        $this->db->select($str)->from($this->table);
        $this->db->where_in('wl_id',$idstr);
        $query = $this->db->get();        
        foreach ($query->result_array() as $row)
        {
            $data[$row['wl_id']][] =   $row;           
        }
        return $data;         
    }

}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */