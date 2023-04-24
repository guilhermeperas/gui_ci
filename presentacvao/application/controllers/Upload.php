<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $config['upload_path'] = FCPATH . 'application/uploads/';
        $config['allowed_types']= 'txt|zip';
        $config['max_size']= 100;
        $config['max_width']= 1024;
        $config['max_height']= 768;
        $this->load->library('upload', $config);
    }
    public function index(){
        $data['title'] = "Upload";
        $data['error'] = '';
        $this->load->view('upload', $data);
    }
    public function do_upload(){
        if ( ! $this->upload->do_upload('userfile')){
            $data['error'] = $this->upload->display_errors();
            $data['title'] = "Upload";
            $this->load->view('upload', $data);
        }else{
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload_success', $data);
        }
    }
}

?>