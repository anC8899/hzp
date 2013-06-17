<?php

class Upload extends CI_Controller {
 
 function __construct()
 {
  parent::__construct();
  $this->load->helper(array('form', 'url'));
 }
 
 function index()
 { 
  $this->load->view('upload_form', array('error' => ' ' ));
 }

 function do_upload()
 {
    $phone_num  =   $this->input->post('phone_num');
    $this->db->select('n_id');
    $this->db->from('phone_number');
    $this->db->where('number', $phone_num); 
    $query  =   $this->db->get();    
    $row    =   $query->result_array($query);
    
    if(!$row)
    {
        echo "对不起，此号码不能参加活动";die;
    }

    if( ! file_exists("./uploads/{$phone_num}"))
    {
        mkdir("./uploads/{$phone_num}");        
    }    
    
      $config['upload_path'] = './uploads/'.$phone_num;
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '100';
      $config['max_width']  = '1024';
      $config['max_height']  = '768';
      
      $this->load->library('upload', $config);
 
      if ( ! $this->upload->do_upload())
      {
       $error = array('error' => $this->upload->display_errors());
       
       $this->load->view('upload_form', $error);
      } 
      else
      {
        $upload_data    =   $this->upload->data();
        
        $img_data = array(
               'img_url' => "/uploads/{$phone_num}/". $upload_data['file_name'] ,
               'n_id'    => "{$row[0]['n_id']}" ,
            );

        $this->db->insert('upload_photo', $img_data);
         
       $data = array('upload_data' => $upload_data);
       
       $this->load->view('upload_success', $data);
      }
 } 
}
