<?php 
class Applynow_mod extends CI_Model {
    
    var $table = 'applynow';

    function __construct()
    {
        parent::__construct();
        $this->table = $this->db->dbprefix($this->table);
    }
}
/* End of file Number.php */
/* Location: ./application/admin/models/Number.php */