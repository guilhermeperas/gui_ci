<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitas_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'receita';
	}
	public function getReceitaData($id){
		$this->db->select('medico.nome AS medico, utente.nome AS utente,receita.*,consulta.data AS data,consulta.estado AS estado');
		$this->db->join('consulta', 'consulta.id = receita.id_consulta', 'inner');
		$this->db->join('medico', 'medico.id = consulta.id_medico', 'inner');
		$this->db->join('utente', 'utente.id = consulta.id_utente', 'inner');
		$this->db->where('receita.id', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
	}
	public function getProdutosReceita($id){
		$this->db->select('produto.nome,produto.value');
		$this->db->join('receita_produto', 'receita_produto.id_produto = produto.id', 'inner');
		$this->db->where('receita_produto.id_receita', $id);
		$query= $this->db->get('produto');
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
}
