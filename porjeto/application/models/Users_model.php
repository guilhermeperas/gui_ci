<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'users';
	}
    public function getProfile(){
        
    }
}
