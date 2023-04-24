<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseUpload extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library('image_lib','upload');
    }
    public function index(){
        $data['title'] = "Page - Home";
        $this->load->view('upload',$data);
    }

    public function Upload(){
        $data['title'] = "Page - Upload";
        // $this-> image_lib -> chamada a bib.
        // upload->do_upload('valor do post');

        if(!$this->upload->do_upload('image')){
            $data['info'] = $this->upload->display_errors();
        }else{
            // upload->data() -> info do upload
            $data['info_upload'] = $this->upload->data();
        }
        $this->load->view('upload',$data);
    }
}