<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->library('passwordhash'); // se der error checka o nome da classe passwordjash
        $this->passwordhash->initialize(8,false);
		$this->load->model('users_model');
        $this->users_model->initialize($this->passwordhash);
		$this->data = array(
			'action' => base_url('log_in'),
			'css' => base_url("resources/css/login.css"),
		);
    }
    public function index()
	{
		if($this->users_model->isLoggedIn()){
			redirect(base_url('backoffice/users'));
			return;
		}
		$this->singleView('Login',$this->data);
	}
	public function login(){
		$this->form_validation->set_rules('username','user','required');
		$this->form_validation->set_rules('password','senha','required');
		if($this->form_validation->run() && !empty($this->input->post())){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($user = $this->users_model->getByUsername($username))
				if($this->users_model->checkPassword($password,$user['password'])){
					$this->users_model->createSession($user);
					redirect(base_url().'homepage');
					return;
				}
		}
		$this->data['error'] = 'Dados inválidos';
		$this->singleView('Login',$this->data);
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->data['logout_sucess'] = 'logout com sucesso!!!';
		$this->singleView('Login',$this->data);
	}
    public function backOffice(){
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'login');
        }
        $user = $this->session->userdata('user');

        $this->data['action'] = base_url('backoffice/users/'); // para os forms
        $this->data['user'] = $this->users_model->getProfile($user['id'],$user['tipo']);
        if($this->data['user']['tipo'] === 'admin')
            $this->data['list'] = $this->users_model->getAllUsers();

        $this->loadBackOfficeView('backoffice/users',$this->data);
    }
    public function editUser(){
        $id = $this->uri->segment(4);
        if(!$id)
            return;
        $tipo = $this->uri->segment(5);
        if(!$tipo)
            return;
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'login');
            return;
        }
        // pegar os dados do id pedido.
        $user = $this->users_model->getProfile($id,$tipo);
        if(!isset($user)){
            $this->data['error'] = 'User nao existe';
            $this->loadBackOfficeView('backoffice/users',$this->data,$this->data['user']['tipo']);
            return;
        }
        // verificar se mudou alguma coisa
        if($this->input->post()){
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
        }
        if(!empty($password)){
            if(!$this->users_model->checkPassword($password,$user['password']))
                $password = $this->users_model->HashPassword($password);
        }else
            $password = $user['password'];
        if($user['username'] === $username && $user['email'] === $email){
            $this->data['error'] = 'Nao alterou nada!';
            $this->loadBackOfficeView('backoffice/users',$this->data,$user['tipo']);
            return;
        }
        // if($this->users_model->checkExists($username)) // TODO function para verificar se o username ou email ja existem
        if($this->users_model->Update($id,array('username' => $username,'email' => $email,'password' => $password))){
            $user = $this->session->userdata('user');
            if($user['id'] === $id && $user['tipo'] === $tipo){
                $this->users_model->createSession(array('id' => $id,'tipo' => $tipo));
                $this->data['user'] = $this->session->userdata('user');
            }
            redirect(base_url().'backoffice/users');
        }
    }
}