<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model { 
    protected $table = 'user'; 
    protected $phpass;
    public function initialize($p){
        $this->phpass = $p;
    }
	function __construct(){
		parent::__construct();
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
        print_r($user);
        if($logged_in == TRUE){
            $this->createSession(
                array(
                    'user_id' =>$user[0]->id,
                    'tipo' =>$user[0]->tipo
                )
            );
            return true;
        }
        return false;
    }
    public function getByType($id,$type){ // todo usar o values e fazer classe abstrata com esta func
        $this->db->select($type.'.*,'.'user.tipo,user.email');
        $this->db->join($this->table, $type.'.id = user.user_id', 'inner');
        $query = $this->db->get_where($type, array('id' => $id,'tipo' => $type));
        return $query->result();
    }
    public function createSession($user_data){
        $this->session->set_userdata(array('logged_in' => true,'user'=> $this->getByType($user_data['user_id'],$user_data['tipo'])));
    }
}
