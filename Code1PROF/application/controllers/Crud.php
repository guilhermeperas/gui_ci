<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller { 
	private $data;
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->model('crud_model');
	}
	public function index(){
		$data['users'] = $this->crud_model->get_clients();
		$data['title'] = 'Users list';
    	$this->load->view('crud/index',$data);
	}
	public function create(){
		$data['title'] = 'Create User';
		$this->load->view('crud/create',$data);
	}
	public function save(){
		$this->crud_model->create();
		redirect(base_url('crud/index'));
	}
	public function delete(){
		$id = $this->uri->segment(3);
		$user = $this->crud_model->delete($id);
		redirect(base_url('crud/index'));
	}
	public function edit(){
		$id= $this->uri->segment(3);
		$data = array();
		if(empty($id))
			show_404();
		else{
			$data['user'] = $this->crud_model->get_user_by_id($id);
			$this->load->view('crud/edit',$data);
		}
	}
}
