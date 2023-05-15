<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {
    protected $table = 'users'; 
	function __construct(){
		parent::__construct();
	}
    public function get_clients(){
        $query = $this->db->get($this->table);
        return $query->result(); 
    }
    public function create(){
        # este array é para ser feito no controlador
        $data = array(
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
        );
        $this->db->insert($this->table,$data);
    }
    public function delete($id){
        $this->db->where('id',$id);
        return $this->db->delete($this->table);
    }
    public function get_user_by_id($id){
        $query = $this->db->get_where($this->table,array('id' => $id));
        return $query->row();
    }
    public function update(){
        # este array é para ser feito no controlador
        $data = array(
            'id' => $this->input->post('id'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
        );
        $this->db->where('id',$data['id']);
        $this->db->insert($this->table,$data);
    }
}
