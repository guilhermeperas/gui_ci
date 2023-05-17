<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('fileloader'));
	}
	public function index()
	{
		$data = array(
			'title' => 'Home Page',
			'css' => base_url("resources/css/home_page.css"),
		);
		$this->fileloader->loadView('HomePage',$data);
	}
}
