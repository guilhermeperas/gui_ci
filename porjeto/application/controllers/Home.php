<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->data['css'] = base_url("resources/css/homepage.css");
		$this->data['title'] = 'Home';
		$this->fileloader->loadView('HomePage',$this->data);
	}
}
