<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	// atrb. que rep. a tabela
	var $table = "";
	function __construct(){
		parent::__construct();
	}
	// return boolean rec. array
	public function Insert($data){
		if(!isset($data))
			return false;
			// insert(table, data)
		return $this->db->insert($this->table, $data);
	}
	// return array
	function GetById($id) {
		if(is_null($id))
			return false;
		//where(nomecampotabela, valor)
		$this->db->where('id', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
	}
	/* Lista todos os registos da tabela
		$sort Campo para ordenação dos registos
		$order Tipo de ordenação: ASC ou DESC
		returna array
  */
	function GetAll($sort = 'id', $order = 'asc') {
		 $this->db->order_by($sort, $order);
		 $query = $this->db->get($this->table);
		 if ($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}
	/* Atualiza um registo na tabela
	$int ID do registo a ser atualizado
	$data Dados a serem inseridos
	returna boolean
  */
	 function Update($id, $data) {
		if(is_null($id) || !isset($data))
			return false;
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	 }
	/* Remove um registo na tabela
	$int ID do registo a ser eliminado
	returna boolean
  */
   function Delete($id) {
    if(is_null($id))
      return false;
	$this->db->where('id', $id);
	return $this->db->delete($this->table);
   }
}
