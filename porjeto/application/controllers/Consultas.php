<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas extends MY_Controller { // criar classe abstrata para uma classe que use o paginador
    function __construct(){
        parent::__construct();
        $this->load->model('consultas_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Consultas";

        $config["base_url"] = base_url()."consultas";
        $config["per_page"] = 2;
        $config["total_rows"] = $this->consultas_model->get_count();

        $this->initialize($config);

        $this->loadLista('consultas',$this->session->userdata('logged_in'));
    }
}