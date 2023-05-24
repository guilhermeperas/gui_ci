<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	// atrb. que rep. a tabela
	var $table = "";
	function __construct(){
		parent::__construct();
	}
	// return boolean rec. array
	public function initializeLimit($limit,$start){
		$this->db->limit($limit,$start);
	}
	public function create($data){
		if(!isset($data))
			return false;
			// insert(table, data)
		return $this->db->insert($this->table, $data);
	}
	public function get_count(){
        return $this->db->count_all($this->table);
    }
	public function last_inserted_id(){
		return $this->db->insert_id();
	}
	function GetById($id) {
		if(is_null($id))
			return false;
		$this->db->where('id', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
	}
	function GetAll($sort = 'id', $order = 'asc') {
		 $this->db->order_by($sort, $order);
		 $query = $this->db->get($this->table);
		 if ($query->num_rows() > 0)
			return $query->result_array();
		else
			return null;
	}

	function Update($id, $data) {
		if(is_null($id) || !isset($data))
			return false;
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}
   function delete($id) {
    if(is_null($id))
      return false;
	$this->db->where('id', $id);
	return $this->db->delete($this->table);
   }
}
