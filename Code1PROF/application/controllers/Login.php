<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller { 
    private $data; // variavel para mostrar as mensagens
	function __construct(){
		parent::__construct();
        $this->load->library(array('form_validation','session','passwordhash')); // se der error checka o nome da classe passwordjash
        $this->passwordhash->initialize(8,false);
		$this->load->model('login_model');
        $this->login_model->initialize($this->passwordhash);

	}
	public function index(){
    	$this->load->view('login');
	}
	public function login(){
		if($this->login_model->isLoggedIn())
			redirect('admin');
		$this->form_validation->set_rules('username','user','required');
		$this->form_validation->set_rules('password','senha','required');
		if($this->form_validation->run()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($user = $this->login_model->getByUsername($username))
				if($this->login_model->checkPassword($password,$user['password'])){ // pequeno erro super insano aqui desafio,
					$this->login_model->createSession($user);
					redirect(base_url().'admin'); // mesma linha que a 19
				}
		}
		$this->data['error'] = 'Dados inválidos';
		$this->load->view('login',$this->data);
	}
	public function logout(){
		// session_destroy(); // php classico
		$this->session->destroy(); 
		$this->data['logout_sucess'] = 'logout com sucesso!!!';
		$this->load->view('login',$this->data);
	}
}
