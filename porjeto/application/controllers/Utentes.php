<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utentes extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->model('utentes_model');
    }
    
    public function index(){
        $this->data['title'] = "Lista Utentes";
        $this->data['css'] = base_url("resources/css/listas.css");

        $config["base_url"] = base_url()."utentes";
        $config["per_page"] = 4;
        $config["total_rows"] = $this->utentes_model->get_count();

        $this->initialize($config);

        $this->loadLista('utentes',$this->session->userdata('logged_in'));
    }
    public function backoffice(){
        if(is_null($this->data['user']))
            redirect(base_url().'login');

        $this->data['title'] = "BackOffice Consultas";
        $this->data['list'] = $this->utentes_model->getLoggedInList();
        $this->data['h1_text'] = 'Todos os utentes';
        $this->data['hasPerms'] = $this->data['user']['tipo'] == 'admin' ? true : false;
        if($this->data['hasPerms'])
            $this->data['create_utente'] = base_url().'utentes/createUtente';

        $this->loadBackOfficeView('backoffice/utente/utentes',$this->data,$this->data['user']['tipo']);
    }
    public function createUtente(){
		$this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('nUtente','Numero de Utente','required|min_length[9]|max_length[9]');
        if($this->input->post('newMorada'))
		    $this->form_validation->set_rules('morada','Morada','required');
        else
		    $this->form_validation->set_rules('select_morada','Morada','required');
        if($this->form_validation->run()){
            if($this->input->post('newMorada')){
                $this->load->model('moradas_model');
                $morada = $this->input->post('morada');
                if(!$this->moradas_model->create(array('nome' => $morada)))
                    redirect(base_url().'backoffice/utentes');
                $last_id = $this->moradas_model->last_inserted_id();
                $values = array(
                    'nome' => $this->input->post('nome'),
                    'nUtente' => $this->input->post('nUtente'),
                    'id_morada' => $last_id,
			    );
                unset($this->moradas_model);
            }
            else{
                $values = array(
                    'nome' => $this->input->post('nome'),
                    'nUtente' => $this->input->post('nUtente'),
                    'id_morada' => $this->input->post('select_morada'),
			    );
            }
            if($this->utentes_model->create($values)){
                redirect(base_url().'backoffice/utentes');
            }
            $this->data['error'] = 'Erro ao criar receita';
        }
        $this->load->model('moradas_model');
        $this->data['moradaList'] = $this->moradas_model->GetAll();
        unset($this->moradas_model);
        $this->data['form_action'] = base_url().'utentes/createUtente';
        $this->loadBackOfficeView('backoffice/utente/createUtente',$this->data,$this->data['user']['tipo']);
    }
    public function deleteUtente(){
        $id = $this->uri->segment(4);
        if(is_null($id))
            redirect(base_url().'backoffice/utentes');
        $this->utentes_model->delete($id);
        redirect(base_url().'backoffice/utentes');
    }
    public function editarUtente(){ // TODO NEEDS FINISHING
        $id = $this->uri->segment(4);
        if(is_null($id))
            redirect(base_url().'backoffice/utentes');
        $this->data['utente'] = $this->utentes_model->getLoggedInList(array('utente.id' => $id));
        $this->load->model('moradas_model');
        $this->data['moradaList'] = $this->moradas_model->GetAll();
        unset($this->moradas_model);
        $this->loadBackOfficeView('backoffice/utente/editUtente',$this->data,$this->data['user']['tipo']);
    }
}