<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		if(!$this->session->userdata('logged_in')){
			redirect(base_url().'login');
		}
		$this->data['css'] = base_url("resources/css/backoffice.css");
		$this->data['title'] = 'Backoffice';
		$this->data['menuRoutes'] = array(
                    array('name' => 'Users','path' => base_url('home')),
                    array('name' => 'Medicos','path' => base_url('home')),
                    array('name' => 'Enfermeiros','path' => base_url('medicos')),
                    array('name' => 'Utentes','path' => base_url('utentes')),
                    array('name' => 'Consultas','path' => base_url('consultas')),
                    array('name' => 'Receitas','path' => base_url('consultas')),
                    array('name' => 'Logout','path' => base_url('logout')),
		);
		$this->fileloader->singleView('Backoffice',$this->data);
	}
}
