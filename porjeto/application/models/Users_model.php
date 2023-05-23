<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'user';
	}
    public function getProfile($id,$type){
        if(is_null($id))
			return false;
		if(is_null($type))
			return false;
		$this->db->where('user_id', $id);
		$this->db->where('tipo', $type);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
    }
	public function getAllUsers(){
		$this->db->select('user_id,username,email,tipo');
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
}
