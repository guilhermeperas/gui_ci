<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends MY_Controller {
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->data['css'] = base_url("resources/css/backoffice.css");
		$this->data['title'] = 'Backoffice';
		$this->fileloader->loadView('Backoffice',$this->data,false);
	}
}
