<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {
    protected $phpass;
	function __construct(){
		parent::__construct();
		$this->table = 'user';
	}
    public function initialize($p){
        $this->phpass = $p;
    }
    public function getProfile($id,$type){
        if(is_null($id))
			return false;
		if(is_null($type))
			return false;
		$this->db->where('id', $id);
		$this->db->where('tipo', $type);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
    }
	public function getAllUsers(){
		$this->db->select('id,username,email,tipo');
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
	}
	public function getByUsername($username){
        $user = array('username' => $username);
        $query = $this->db->get_where($this->table,$user,1);
        if($query->num_rows() > 0) 
            return $query->row_array();
        return false;
    }
    public function checkPassword($password,$hashedPassword){ 
        return $this->phpass->CheckPassword($password,$hashedPassword);
    }
    public function crypt_password($p){
        return $this->phpass->HashPassword($p);
    }
    public function isLoggedIn(){
        $logged_in = $this->session->userdata('logged_in');
        $user = $this->session->userdata('user');
        if($logged_in == TRUE){
            $this->createSession(
                array(
                    'id' =>$user['id'],
                    'tipo' =>$user['tipo']
                )
            );
            return true;
        }
        return false;
    }
    public function getByType($id,$type){ 
        $this->db->select($type.'.*,'.'user.tipo,user.email,user.username');
        $this->db->join($this->table, $type.'.id = user.id', 'inner');
        $query = $this->db->get_where($type, array($type.'.id' => $id,'tipo' => $type));
        return $query->row_array();
    }
    public function createSession($user_data){
        $this->session->set_userdata(array('logged_in' => true,'user'=> $user_data));
    }
}
