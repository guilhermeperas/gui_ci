<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller { 
    function __construct(){
        parent::__construct();
        $this->load->model('users_model');
    }
    public function backOffice(){
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'login');
        }
        $user = $this->session->userdata('user');
        $this->data['user'] = $user[0];
        switch($this->data['user']->tipo){
            case 'admin': 
                $this->data['menuRoutes'] = array(
                    array('name' => 'Users','path' => base_url('backoffice/users')),
                    array('name' => 'Medicos','path' => base_url('backoffice/medicos')),
                    array('name' => 'Enfermeiros','path' => base_url('backoffice/enfermeiros')),
                    array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
                    array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
                    array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
		        );
                break;
                case 'medico':
                case 'enfermeiros':
                    $this->data['menuRoutes'] = array(
                        array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
                        array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
                        array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
		            );
                break;
                case 'utente':
                    $this->data['menuRoutes'] = array();
                    break;
                case 'rececionista':
                    $this->data['menuRoutes'] = array(
                        array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
		            );
                break;
        }

        array_push($this->data['menuRoutes'],
                array('name' => 'Perfil','path' => base_url('backoffice/users')),
                array('name' => 'Consultas','path' => base_url('backoffice/consultas')),
                array('name' => 'Logout','path' => base_url('logout')),
        );
        
        $this->data['action'] = base_url('backoffice/users/'); // para os forms

        $this->data['css'] = base_url("resources/css/backoffice.css");

        $this->data['user'] = $this->users_model->getProfile($this->data['user']->id,$this->data['user']->tipo);

        $this->data['list'] = $this->users_model->getAllUsers();

        $this->fileloader->singleView('backoffice/menu',$this->data);
                        
        $this->fileloader->singleView('backoffice/users',$this->data);

        $this->fileloader->singleView('backoffice/footer');

    }
    public function editUser(){
        $id = $this->uri->segment(4);
        if(!$id)
            return;
        if(!$this->session->userdata('logged_in')){
            redirect(base_url().'login');
        }
        if(empty($this->input->post))  
            return;
        $username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
        // if($this->usermodel->checkUser()){ // ver se alterou algo

        // }
    }
}