<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enfermeiros_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'enfermeiro';
	}
	public function getNameEspecialidade(){
		$this->db->select('nome, especialidade');
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
