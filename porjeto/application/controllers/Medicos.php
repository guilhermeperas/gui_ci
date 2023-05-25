<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->model('medicos_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Medicos";
        $this->data['css'] = base_url("resources/css/listas.css");

        $config["base_url"] = base_url()."medicos";
        $config["per_page"] = 3;
        $config["total_rows"] = $this->medicos_model->get_count();

        $this->initialize($config);

        $this->loadLista('medicos',$this->session->userdata('logged_in'));
    }
    function backoffice(){
		if(is_null($this->data['user']))
            redirect(base_url().'login');
        $this->data['title'] = "BackOffice Medicos";
        $this->data['base_url'] = base_url();
		$this->data['list'] = $this->medicos_model->getLoggedInList();
        $this->data['h1_text'] = 'Todas os Medicos';
        $this->data['hasPerms'] = $this->data['user']['tipo'] === 'admin' ? true : false;
        $this->data['create_Prof'] = base_url().'medico/createMedico';
        $this->data['prof'] = 'medicos';
        $this->loadBackOfficeView('backoffice/prof_saude/prof_saude',$this->data);
	}
    function criarMedico(){
        if($this->data['user']['tipo'] != 'rececionista' || $this->data['user']['tipo'] != 'admin'){
            redirect(base_url().'backoffice/medicos');
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
            if($this->medicos_model->create($values)){
                redirect(base_url().'backoffice/medicos');
            }
            $this->data['error'] = 'Erro ao criar medico';
        }
        $this->load->model('moradas_model');
        $this->data['moradaList'] = $this->moradas_model->GetAll();
        unset($this->moradas_model);
        $this->data['form_action'] = base_url().'medico/createMedico';
        $this->loadBackOfficeView('backoffice/prof_saude/createProf',$this->data);
    }
}