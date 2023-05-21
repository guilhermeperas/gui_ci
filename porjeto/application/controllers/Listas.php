<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends MY_Controller { // TODO este controler precisa de olhos
	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
	}
	public function index(){
		$list = $this->uri->segment(1);
		if(!isset($list))
			redirect(base_url('homepage'));
		$this->load->model($list.'_model');
		$data = array(
			'title' => 'Lista de '.$list,
			'css' => base_url("resources/css/listas.css"),
			'receita_url' => base_url('receita'),
		);
		// pagination teste 
		// $config["base_url"] = base_url($list);
        // $config["per_page"] = 1;
		// $config["total_rows"] = $this->{$list . '_model'}->get_count();
		// $this->pagination->initialize($config);
        // $page = ($this->uri->segment(3) ? $this->uri->segment(3) : 0);
        // $data["links"] = $this->pagination->create_links();
		
		if(!empty($this->session->userdata('user')))
			$user = $this->session->userdata('user');
		if(!$this->session->userdata('logged_in') || $user[0]->tipo == 'utente'){
			$data['list'] = $this->{$list . '_model'}->getNotLoggedInList($config["per_page"] , $page);
			$this->fileloader->loadView('lists/logoff/l'.$list,$data);
			return;
		}
		$data['list'] = $this->{$list . '_model'}->getLoggedInList($config["per_page"] , $page);
		$this->fileloader->loadView('lists/login/l'.$list,$data);
		return;

		// load lista
	}
}
