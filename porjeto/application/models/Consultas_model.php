<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'consulta';
	}
	public function getNotLoggedInList(){
		$this->db->select('medico.nome AS medico, utente.nome AS utente');
		$this->db->join('medico', 'medico.id = consulta.id_medico', 'inner');
		$this->db->join('utente', 'utente.id = consulta.id_utente', 'inner');
		$query = $this->db->get_where('consulta', array('data' => date("Y/m/d")));
		return $query->result();
	}
	public function getLoggedInList(){
		$this->db->select('consulta.id AS id,consulta.data AS data,medico.nome AS medico,utente.nome AS utente,consulta.id_receita AS receita');
		$this->db->join('medico', 'medico.id = consulta.id_medico', 'inner');
		$this->db->join('utente', 'utente.id = consulta.id_utente', 'inner');
		$this->db->order_by('data', 'ASC');
		$query = $this->db->get($this->table);
		return $query->result();
	}
}
