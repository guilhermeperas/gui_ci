<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {
    protected $data = array(
        'css' => null,
        'title' => null,
    );
    private $page;
    private $per_page;
	function __construct(){
		parent::__construct();
        $this->data['user'] = $this->session->userdata('user');
	}
    protected function initialize($config){
        $this->load->library('pagination');
        $this->per_page = $config["per_page"];
        $this->pagination->initialize($config);

        $this->page = ($this->uri->segment(2) ? $this->uri->segment(2) : 0); // variavel big boy $this
        $this->data["links"] = $this->pagination->create_links();
    }
    protected function loadLista($name,$logged_in){
        $this->data['css'] = base_url("resources/css/listas.css");
        $this->{$name . '_model'}->initializeLimit($this->per_page , $this->page);
        if($this->session->userdata('logged_in')){
            $this->data["list"] = $this->{$name . '_model'}->getLoggedInList();
            $this->fileloader->loadView('lists/login/l'.$name,$this->data);
            return;
        }
        $this->data["list"] = $this->{$name . '_model'}->getNotLoggedInList();
        $this->fileloader->loadView('lists/logoff/l'.$name,$this->data);
    }
}
