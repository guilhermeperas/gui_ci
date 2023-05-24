<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitas extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('produtos_model');
	}
}
