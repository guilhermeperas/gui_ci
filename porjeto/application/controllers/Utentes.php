<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utentes extends MY_Controller { // criar classe abstrata para uma classe que use o paginador
    function __construct(){
        parent::__construct();
        $this->load->model('utentes_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Utentes";
        $this->data['css'] = base_url("resources/css/listas.css");

        $config["base_url"] = base_url()."utentes";
        $config["per_page"] = 2;
        $config["total_rows"] = $this->utentes_model->get_count();

        $this->initialize($config);

        $this->loadLista('utentes',$this->session->userdata('logged_in'));
    }
}