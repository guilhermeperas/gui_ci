<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->has_userdata('id'))
			redirect(base_url().'login');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data = array(
			'title' => 'Contact us!',
			'css' => base_url("resources/css/contact.css"),
			'nome' => $this->session->userdata('nome'),
			'action' => base_url('sendContact'),
		);
		$this->fileloader->loadView('Contact',$data,false);
	}
	public function sendContact(){ // TODO NEEDS CHECKING BRO
		$this->form_validation->set_rules('name','Nome','required');
		$this->form_validation->set_rules('message','Mensagem','required');
		if($this->form_validation->run()){
			$contact['nome'] = $this->input->post('name');
			$contact['message'] = $this->input->post('message');
			$contact['id'] = $this->session->userdata('id');
			if($this->contact_model->Insert($contact))
				redirect(base_url().'home');; 
		}
	}
}
