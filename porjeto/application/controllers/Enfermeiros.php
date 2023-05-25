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
    function backoffice(){
		if(is_null($this->data['user']))
            redirect(base_url().'login');
        $this->data['title'] = "BackOffice Enfermeiros";
        $this->data['base_url'] = base_url();
		$this->data['list'] = $this->enfermeiros_model->getLoggedInList();
        $this->data['h1_text'] = 'Todos os Enfermeiros';
        $this->data['hasPerms'] = $this->data['user']['tipo'] === 'admin' ? true : false;
        $this->data['create_Prof'] = base_url().'enfermeiro/createEnfermeiro';
        $this->data['prof'] = 'enfermeiros';
        $this->loadBackOfficeView('backoffice/prof_saude/prof_saude',$this->data);
	}
    function criarEnfermeiro(){
        if($this->data['user']['tipo'] != 'admin'){
            redirect(base_url().'backoffice/enfermeiros');
        }
        $this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('especialidade','Especialidade','required');
		$this->form_validation->set_rules('nif','NIF','required|min_length[9]|max_length[9]');
		$this->form_validation->set_rules('iban','IBAN','required|min_length[10]|max_length[34]');
        if($this->input->post('newMorada'))
		    $this->form_validation->set_rules('morada','Morada','required');
        else
		    $this->form_validation->set_rules('select_morada','Morada','required');
        if($this->form_validation->run()){
            if($this->input->post('newMorada')){
                $this->load->model('moradas_model');
                $morada = $this->input->post('morada');
                if(!$this->moradas_model->create(array('nome' => $morada)))
                    redirect(base_url().'backoffice/medicos');
                $last_id = $this->moradas_model->last_inserted_id();
                $values = array(
                    'nome' => $this->input->post('nome'),
                    'especialidade' => $this->input->post('especialidade'),
                    'nif' => $this->input->post('nif'),
                    'iban' => $this->input->post('iban'),
                    'id_morada' =>$last_id,
			    );
                unset($this->moradas_model);
            }
            else{
                $values = array(
                    'nome' => $this->input->post('nome'),
                    'especialidade' => $this->input->post('especialidade'),
                    'nif' => $this->input->post('nif'),
                    'iban' => $this->input->post('iban'),
                    'id_morada' => $this->input->post('select_morada'),
			    );
            }
            if($this->enfermeiros_model->create($values)){
                redirect(base_url().'backoffice/enfermeiros');
            }
            $this->data['error'] = 'Erro ao criar enfermeiros';
        }
        $this->load->model('moradas_model');
        $this->data['moradaList'] = $this->moradas_model->GetAll();
        unset($this->moradas_model);
        $this->data['form_action'] = base_url().'enfermeiros/createEnfermeiro';
        $this->loadBackOfficeView('backoffice/prof_saude/createProf',$this->data);
    }
}