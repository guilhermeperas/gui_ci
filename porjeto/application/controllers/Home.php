<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$data = array(
			'title' => 'Home Page',
			'css' => base_url("resources/css/homepage.css"),
		);
		$this->fileloader->loadView('HomePage',$data);
	}
}
