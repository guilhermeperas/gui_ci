<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller { // TODO PRECISA DE TABELA NA NEW DB
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('contact_model');
	}
	public function index()
	{
		$this->data = array(
			'title' => 'Contact us!',
			'css' => base_url("resources/css/contact.css"),
			'nome' => $this->session->userdata('nome'),
			'action' => base_url('sendContact'),
		);
		$this->fileloader->loadView('Contact',$this->data,false);
	}
	public function sendContact(){ // TODO NEEDS CHECKING BRO
		$this->form_validation->set_rules('name','Nome','required');
		$this->form_validation->set_rules('message','Mensagem','required');
		if($this->form_validation->run()){
			$contact['nome'] = $this->input->post('name');
			$contact['message'] = $this->input->post('message');
			if($this->contact_model->Insert($contact))
				redirect(base_url().'home');; 
		}
	}
}
