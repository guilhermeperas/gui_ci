<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'funcionario';
	}
	public function getNotLoggedInList(){
		$this->db->select('nome, especialidade');
		$query = $this->db->get_where($this->table, array('profissao' => TRUE));
		return $query->result();
	}
}
