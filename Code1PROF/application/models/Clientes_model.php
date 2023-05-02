<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {
    protected $table = 'clientes';
	function __construct(){
		parent::__construct();
	}
    public function get_count(){
        return $this->db->count_all($this->table);
    }
    public function get_clientes($limit,$start){
        $this->db->limit($limit,$start);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    public function get_clientesAll(){
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
