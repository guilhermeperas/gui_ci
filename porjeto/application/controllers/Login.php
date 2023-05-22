<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	function __construct(){
		parent::__construct();
        $this->load->library(array('form_validation','passwordhash')); // se der error checka o nome da classe passwordjash
        $this->passwordhash->initialize(8,false);
		$this->load->model('login_model');
        $this->login_model->initialize($this->passwordhash);
		$this->data = array(
			'action' => base_url('log_in'),
			'css' => base_url("resources/css/login.css"),
		);

	}
	public function index()
	{
		if($this->login_model->isLoggedIn()){
			redirect(base_url('backoffice'));
			return;
		}
		$this->fileloader->singleView('Login',$this->data,false);
	}
	public function login(){
		$this->form_validation->set_rules('username','user','required');
		$this->form_validation->set_rules('password','senha','required');
		if($this->form_validation->run()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($user = $this->login_model->getByUsername($username))
				if($this->login_model->checkPassword($password,$user['password'])){
					$this->login_model->createSession($user);
					redirect(base_url().'homepage');
					return;
				}
		}
		$this->data['error'] = 'Dados inválidos';
		$this->fileloader->singleView('Login',$this->data,false);
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->data['logout_sucess'] = 'logout com sucesso!!!';
		$this->fileloader->singleView('Login',$this->data);
	}
}
