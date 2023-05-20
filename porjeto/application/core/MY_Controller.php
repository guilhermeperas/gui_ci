<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    protected $data = array(
        'css' => null,
        'title' => null,
    );
	function __construct(){
		parent::__construct();
	}
}
