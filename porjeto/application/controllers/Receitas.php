<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitas extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('receitas_model');
		$this->data['css'] = base_url("resources/css/receitas.css");
		$this->data['user'] = $this->session->userdata('user');
	}
	public function backOffice()
	{
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'login');
			return;
		}
		$this->data['list'] = $this->receitas_model->GetAll();
		$this->data['h1_text'] = 'Receitas';
		$this->data['base_url'] = base_url('');
		$this->data['create_receita'] = base_url().'receitas/createReceita';
		$this->loadBackOfficeView('backoffice/receita/receitas',$this->data);
	}
	public function editReceita(){
		
	}
	public function individual(){ 
		if(!$this->uri->segment(2))
			redirect(base_url().'homepage');
		if(!$this->session->userdata('logged_in'))
			redirect(base_url('homepage'));
		$id = $this->uri->segment(2);
		$receita = $this->receitas_model->getReceitaData($id);
		if(empty($receita)){
			$this->data['error'] = 'A Receita nao existe!';
			$this->loadView('receitas/individual',$this->data);
			return;
		}		
		$this->data['title'] = 'Receita individual';
		$this->data['url'] = base_url('');
		$this->data['receita'] = $receita;
		$this->data['hasPerms'] = $this->data['user']['tipo'] === 'utente' ? false : true;
		$this->loadView('receitas/individual',$this->data);
	}
	public function createReceita(){ // TODO FALTA O UPLOAD AQUI
		if($this->data['user']['tipo'] === 'utente' || $this->data['user']['tipo'] === 'rececionista'){
            redirect(base_url().'login');
        }
		$this->form_validation->set_rules('cuidado','Cuidado','required');
		$this->form_validation->set_rules('receita','Receita','required');
		$this->form_validation->set_rules('id_consulta','Consulta','required');
        if($this->form_validation->run()){
			$values = array(
				'cuidado' => $this->input->post('cuidado'),
				'receita' => $this->input->post('receita'),
				'id_consulta' => $this->input->post('id_consulta'),
			);
            if($this->receitas_model->create($values)){
				$last_id = $this->receitas_model->last_inserted_id();
                redirect(base_url().'consultas/update/'.$values['id_consulta'].'/'.$last_id);
			}
            $this->data['error'] = 'Erro ao criar receita';
        }
        $this->data['form_action'] = base_url().'receitas/createReceita';
		$this->load->model('consultas_model'); // metodo super errado 
        $this->data['consultaList'] = $this->consultas_model->getConsultasWithNotReceita();
        unset($this->consultas_model);
        $this->loadBackOfficeView('backoffice/receita/createReceita',$this->data);
    }
	public function downloadReceita(){
		$id = $this->uri->segment(2);
		$receita = $this->receitas_model->getReceitaData($id);
		$produto = $this->receitas_model->getProdutosReceita($id);
		if(empty($receita))
			return;
		$this->load->helper('download');
		$name = "receita.txt";
		$data = 
			"Data da consulta: ".$receita['data']." 
			Estado: ".$receita['estado']."
			Cuidado: ".$receita['cuidado']."
			Utente: ".$receita['utente']."
			Medico: ".$receita['medico']."
			Receita: ".$receita['receita'];
		// TODO check this 
		foreach($produtos as $produto){
			$data .= 
			"Produto: ".$produto->nome."
			Produto: ".$produto->value;
		}
		force_download($name,$data);
	}
	public function enviarEmail(){
		if(!$this->session->userdata('logged_in')){ // nunca entra aqui
			return;
		}	
		if(empty($this->session->userdata('user'))){
			redirect(base_url('login'));
		}
		$id = $this->uri->segment(2);
		$receita = $this->receitas_model->getReceitaData($id);
		if(empty($receita))
			return; // add error message here
		$this->load->library('Mymailer');
		$msg = "
		<!DOCTYPE html>
		<html>
		<body>
			<h1>Ola,este email e da clinica dos ouricos</h1>
			<p>Aqui estao os dados da receita</p>
			<p>Data da consulta: ".$receita['data']." </p>
			<p>Estado: ".$receita['estado']." </p>
			<p>Cuidado: ".$receita['cuidado']." </p>
			<p>Utente: ".$receita['utente']." </p>
			<p>Medico: ".$receita['medico']." </p>
			<p>Receita: ".$receita['receita']." </p>
			<p>Cumprimentos,</p>
			<p>Clinica dos ouricos</p>
		</body>
		</html>
			";
		if(!$this->mymailer->send($this->data['user']['email'],"Receita",$msg)){ // ?
			redirect(base_url().'homepage'); 
		}
	}
}
