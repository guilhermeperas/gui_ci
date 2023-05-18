<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_TESTE extends MY_Model { // todo find the fix for this
	function __construct(){
		parent::__construct();
	}
	public function getNameEspecialidade(){
		$this->db->select('nome, especialidade');
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
