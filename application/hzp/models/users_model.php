<?php 
class Users_model extends CI_Model {
    
    var $table = 'user';
    var $id = 'userid';

    function __construct()
    {
        parent::__construct();
    }    

    
    //获取
    Public function getData($bid)
    {
        $this->db->select('*')->from($this->table)->where($this->id, $bid);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function getDatalist($id1,$id2)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('usergroup as ug','ug.groupid ='.$this->table.'.group','left');
        $this->db->order_by($this->id,'desc')->limit($id2,$id1);
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
    
    //验证账号是否重复
    public function verifyUsername($username)
    {
        $this->db->select($this->id)->from($this->table)->where('username', $username);
        $query = $this->db->get();
        
        if($query->num_rows())
        {
            return FALSE;            
        }
        return TRUE;
        
    }
    
    //更新列表    
    Public function updateUsers($data,$userid)
    {
        $this->db->where($this->id,$userid);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();        
    } 
    
    //添加
    Public function insertUsers($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();        
    }
    
    //验证账号和密码是否正确，登录
    public function verifylogin($username,$pass)
    {
        $data = array(
                        'username' => $username,
                        'password' => md5($pass.md5($this->config->item('encryption_key'))),
                        'is_activ' => 1,
                    );
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('usergroup as up','group = up.groupid');
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row_array();           
    }
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */