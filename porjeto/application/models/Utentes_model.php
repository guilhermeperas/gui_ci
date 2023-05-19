<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utentes_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'utente';
	}
	public function getNotLoggedInList(){
		$this->db->select('morada.nome AS morada, utente.nome AS nome');
		$this->db->from('utente');
		$this->db->join('morada', 'morada.id = utente.id_morada', 'inner');
		$query = $this->db->get();
		return $query->result();
	}
}
