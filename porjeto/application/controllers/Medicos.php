<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos extends MY_Controller { // criar classe abstrata para uma classe que use o paginador
    function __construct(){
        parent::__construct();
        $this->load->model('medicos_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Medicos";
        $this->data['css'] = base_url("resources/css/listas.css");

        $config["base_url"] = base_url()."medicos";
        $config["per_page"] = 2;
        $config["total_rows"] = $this->medicos_model->get_count();

        $this->initialize($config);

        $this->loadLista('medicos',$this->session->userdata('logged_in'));
    }
}