<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicos_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'medico';
	}
	public function getNotLoggedInList($limit,$start){
		$this->db->limit(1,$start);
		$this->db->select('nome, especialidade');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function getLoggedInList(){
		$this->db->select('medico.*, morada.nome AS morada');
		$this->db->join('morada', 'morada.id = medico.id_morada', 'inner');
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
