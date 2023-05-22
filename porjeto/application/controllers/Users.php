<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function profile(){
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'login');
            return;
        }
    }
}