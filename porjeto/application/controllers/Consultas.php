<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->model('consultas_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Consultas";
        $this->data['receita_url'] = base_url('receita');
        $config["base_url"] = base_url()."consultas";
        $config["per_page"] = 1;
        $config["total_rows"] = $this->consultas_model->get_count();

        $this->initialize($config);

        $this->loadLista('consultas',$this->session->userdata('logged_in'));
    }
}