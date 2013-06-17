<?php
/**
 * 图片投票控制器
 */
class Photo extends CI_Controller {
 
 function __construct()
 {
  parent::__construct();
  //$this->load->helper(array('form', 'url'));
 }
 
 function index()
 {
//    $ip = $this->input->ip_address();
//    print_r($ip);die;
    $this->db->select('*');
    $this->db->from('upload_photo');
    //$this->db->where('number', $phone_num); 
    $query  =   $this->db->get(); 
    foreach ($query->result_array() as $row)
    {
        $data[] =   $row;
    }
    $this->load->view('photo', array('data' => $data ));
 }
 
 function votes($id)
 {
    //$id =   $this->input->get();
    //print_r($id);die;
//    $data = array(
//               'votes' => 'votes+1',
//            );
    $this->db->set('votes','votes+1',FALSE);
    $this->db->where('img_id', $id);
    $this->db->update('upload_photo'); 
 }
}