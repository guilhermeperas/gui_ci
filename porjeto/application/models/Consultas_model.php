<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'consulta';
	}
	public function getNotLoggedInList(){
		$this->db->select('funcionario.nome AS medico, utente.nome AS utente');
		$this->db->join('funcionario', 'funcionario.id = consulta.id_medico', 'inner');
		$this->db->join('utente', 'utente.id = consulta.id_utente', 'inner');
		$query = $this->db->get_where('consulta', array('data' => date("Y/m/d")));
		return $query->result();
	}
}
