<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
	   header("location: ".base_url('index.htm')."");
//	   $this->load->view('header');
//       $this->load->view('index');
//       $this->load->view('footer');
	}
    public function applynow()
    {
        if($applynow = $this->input->post(NULL,TRUE))
        {
            $this->idcard($applynow['idcard']);
            $data = $applynow;
            $data['createtime'] = time();
            if($this->db->insert('applynow', $data))
            {
                echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
                echo "<script>alert('提交成功!');
                self.location='".base_url('index.htm')."';</script>";
            }else{
                echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
                echo "<script>alert('提交失败请重新提交!');
                self.location='".base_url('index.htm')."';</script>";
                //header("location: ".base_url('index.htm')."");
                
            }
            
        }else{
            
            $this->load->helper('form');            
            $this->load->view('applynow');
            
        }
                
    }
    public function idcard($idcard)
    {
        $this->db->select('id')->from('applynow')->where('idcard', $idcard);

        $query = $this->db->get();
        //$query->num_rows();
        if($query->num_rows())
        {
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
            echo "<script>alert('请勿重复提交。谢谢!');
                self.location='".base_url('index.htm')."';</script>";
            die;
            
        }
         
        
    }
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */