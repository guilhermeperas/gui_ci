<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->data['css'] = base_url("resources/css/homepage.css");
		$this->data['title'] = 'Home';
		$this->loadView('HomePage',$this->data);
	}
}
