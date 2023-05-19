<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $data;
	function __construct(){
		parent::__construct();
        $this->load->library(array('form_validation','passwordhash')); // se der error checka o nome da classe passwordjash
        $this->passwordhash->initialize(8,false);
		$this->load->model('login_model');
        $this->login_model->initialize($this->passwordhash);
		$this->data = array(
			'title' => 'Login',
			'css' => base_url("resources/css/login.css"),
			'action' => base_url('log_in'),
		);

	}
	public function index()
	{
		$this->fileloader->loadView('Login',$this->data,false);
	}
	public function login(){
		if($this->login_model->isLoggedIn())
			redirect('profile');
		$this->form_validation->set_rules('username','user','required');
		$this->form_validation->set_rules('password','senha','required');
		if($this->form_validation->run()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($user = $this->login_model->getByUsername($username))
				if($this->login_model->checkPassword($password,$user['password'])){
					$this->login_model->createSession($user);
					redirect(base_url().'profile'); 
				}
		}
		$this->data['error'] = 'Dados inválidos';
		$this->fileloader->loadView('Login',$this->data,false);
	}
	public function logout(){
		$this->session->destroy(); 
		$this->data['logout_sucess'] = 'logout com sucesso!!!';
		$this->fileloader->loadView('Login',$this->data,false);
	}
}
