<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Raiz extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	// .../index.php/raiz/index
	// .../index.php/raiz/
	public function index(){
		$data['title'] = "Home page";
		$data['description'] = "description home page";
		$this->load->view('home',$data);
	}
	
	public function empresa(){
		$data['title'] = "Empresa page";
		$this->load->view('empresa',$data);
	}
	
	
}
