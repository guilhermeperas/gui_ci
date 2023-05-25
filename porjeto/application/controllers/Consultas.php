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
    public function individual(){
        $id = $this->uri->segment(3);
        if(is_null($id))
            redirect(base_url().'login');
        $this->data['consulta'] = $this->consultas_model->getConsultas(array('consulta.id' => $id));
        $this->data['title'] = 'Detalhe da consulta '.$id;
		$this->data['css'] = base_url("resources/css/consultas.css");
		$this->data['base_url'] = base_url();
        $this->loadView('consultas/individual',$this->data);
    }
    public function createConsulta(){
        $this->form_validation->set_rules('medico','Medico','required');
		$this->form_validation->set_rules('utente','Utente','required');
		$this->form_validation->set_rules('data','Data','required');
        if($this->form_validation->run()){
            $values = array(
                'id_medico'=> $this->input->post('medico'),
                'id_utente' => $this->input->post('utente'),
                'data' => $this->input->post('data'),
            );

            if($this->consultas_model->create($values))
                redirect(base_url().'backoffice/consultas');
            $this->data['error'] = 'Erro ao criar user';
        }
        $this->data['form_action'] = base_url().'consulta/createConsulta';
        $this->load->model('utentes_model');
        $this->data['utenteList'] = $this->utentes_model->GetAll();
        unset($this->utentes_model);
        $this->load->model('medicos_model');
        $this->data['medicoList'] = $this->medicos_model->GetAll();
        unset($this->medicos_model);
        $this->loadBackOfficeView('backoffice/consulta/createConsulta',$this->data);
    }
    public function update(){
        $consulta_id = $this->uri->segment(3);
        if(is_null($consulta_id))
            redirect(base_url().'backoffice/receitas');
        $receita_id = $this->uri->segment(4);
        if(is_null($receita_id))
            redirect(base_url().'backoffice/receitas');
        if($this->consultas_model->Update($consulta_id,array('id_receita' => $receita_id))){
            redirect(base_url().'backoffice/receitas');
            return;
        }
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
        $this->data['hasPerms'] = $this->data['user']['tipo'] === 'admin' || $this->data['user']['tipo'] === 'rececionita' ? true : false;
        $this->data['create_consulta'] = base_url().'consulta/createConsulta';
        $this->loadBackOfficeView('backoffice/consulta/consultas',$this->data);
    }
    public function editConsulta(){ // TODO CHECK WHY DATA NOT GOING THROUGH
        $id = $this->uri->segment(3);
        if(is_null($id))
            redirect(base_url().'backoffice/consultas');
		$this->form_validation->set_rules('data','Data','required');
		$this->form_validation->set_rules('estado','Estado','required');
        if($this->form_validation->run()){
            $values = array(
                'data'=> $this->input->post('data'),
                'estado' => $this->input->post('estado'),
            );

            if($this->consultas_model->Update($id,$values))
                redirect(base_url().'backoffice/consultas');
            $this->data['error'] = 'Erro ao atualizar consulta';
        }
        $this->data['consulta'] = $this->consultas_model->getConsultas(array('consulta.id' => $id));
        $this->data['form_action'] = base_url().'consultas/edit/'.$id;
        $this->loadBackOfficeView('backoffice/consulta/editConsulta',$this->data);

    }
}