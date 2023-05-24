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
        $config["total_rows"] = !$this->session->userdata('logged_in') ? $this->consultas_model->get_todays_consultas_count() :  $this->consultas_model->get_count();
        $this->initialize($config);

        $this->loadLista('consultas',$this->session->userdata('logged_in'));
    }
    public function backoffice(){
        if(is_null($this->data['user']))
            redirect(base_url().'login');
        $this->data['title'] = "BackOffice Consultas";
        $this->data['base_url'] = base_url();

        if($this->data['user']['tipo'] === 'utente'){
            $this->data['list'] = $this->consultas_model->getConsultas($this->data['user']['id']);
            $this->data['h1_text'] = 'As suas consultas';
        }else{
            $this->data['list'] = $this->consultas_model->getConsultas();
            $this->data['h1_text'] = 'Todas as consultas';
        }
        $this->fileloader->loadBackOfficeView('backoffice/consultas',$this->data,$this->data['user']['tipo']);

    }
}