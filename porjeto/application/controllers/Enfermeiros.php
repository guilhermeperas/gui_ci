<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enfermeiros extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->model('enfermeiros_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Enfermeiros";

        $config["base_url"] = base_url()."medicos";
        $config["per_page"] = 2;
        $config["total_rows"] = $this->enfermeiros_model->get_count();

        $this->initialize($config);

        $this->loadLista('enfermeiros',$this->session->userdata('logged_in'));
    }
}