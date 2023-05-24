<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enfermeiroconsulta_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'enfermeiro_consulta';
	}
	function getEnfermeirosConsulta($id){
		$this->db->join('enfermeiro', 'enfermeiro_consulta.id_enfermeiro = enfermeiro.id', 'inner');
		$this->db->where('enfermeiro_consulta.id_consulta', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return null;
    }
	function remover($array){
		if(empty($array))
			return false;
		$this->db->where($array);
		return $this->db->delete($this->table);
	}
}
