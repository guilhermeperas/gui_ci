<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    protected $table = 'users';
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
    public function isLoggedIn(){
        // logged_in = $_SESSION['logged_in'];
        $logged_in = $this->session->userdata('logged_in');
        $user = $this->session->userdata('user');
        if($logged_in == TRUE){
            $this->createSession($user);
            return true;
        }
        return false;
    }
    public function createSession($user_data){
        $this->session->set_userdata(array('logged_in' => true,'user'=> $user_data));
    }
}
