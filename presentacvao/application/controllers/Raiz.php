<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Raiz extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data['title'] = "Home Page";
        $this->load->view('home', $data);
    }
}

?>