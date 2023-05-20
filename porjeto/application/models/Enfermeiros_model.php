<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enfermeiros_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'enfermeiro';
	}
	public function getNotLoggedInList(){
		$this->db->select('nome, especialidade');
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function getLoggedInList(){
		$this->db->select('enfermeiro.*, morada.nome AS morada');
		$this->db->join('morada', 'morada.id = enfermeiro.id_morada', 'inner');
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
