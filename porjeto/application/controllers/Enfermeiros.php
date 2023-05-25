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
    function enfermeiroList(){
		$this->data['title'] ='Adicionar Enfermeiro';
		$this->data['css'] = base_url("resources/css/enfermeiros.css");
		$this->data['consulta_id'] = $this->uri->segment(3);
		if(is_null($this->data['consulta_id']))
			redirect(base_url().'consultas');
		$this->data['allList'] = $this->enfermeiros_model->GetAll();
        $this->data['label'] = 'Adicionar Enfermeiro';
        $this->data['selectName'] = "enfermeiro";
		$this->data['form_action'] =  base_url().'enfermeiros/addEnfermeiro/'.$this->data['consulta_id'];
		$this->loadView('mixed/add_something',$this->data);

	}
}