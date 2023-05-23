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
        $this->{$name . '_model'}->initialize($this->per_page , $this->page);
        if($this->session->userdata('logged_in')){
            $this->data["list"] = $this->{$name . '_model'}->getLoggedInList();
            $this->fileloader->loadView('lists/login/l'.$name,$this->data);
            return;
        }
        $this->data["list"] = $this->{$name . '_model'}->getNotLoggedInList();
        $this->fileloader->loadView('lists/logoff/l'.$name,$this->data);
    }
    // public function backOffice(){
    //     $table = $this->uri->segment(2);
    //     if(!$this->session->userdata('logged_in')){
    //         redirect(base_url().'login');
    //     }
    //     switch($this->data['user']->tipo){
    //         case 'admin': 
    //             $this->data['menuRoutes'] = array(
    //                 array('name' => 'Users','path' => base_url('backoffice/users')),
    //                 array('name' => 'Medicos','path' => base_url('backoffice/medicos')),
    //                 array('name' => 'Enfermeiros','path' => base_url('backoffice/enfermeiros')),
    //                 array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
    //                 array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
    //                 array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
	// 	        );
    //             break;
    //             case 'medico':
    //             case 'enfermeiros':
    //                 $this->data['menuRoutes'] = array(
    //                     array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
    //                     array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
    //                     array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
	// 	            );
    //             break;
    //             case 'utente':
    //                 $this->data['menuRoutes'] = array();
    //                 break;
    //             case 'rececionista':
    //                 $this->data['menuRoutes'] = array(
    //                     array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
	// 	            );
    //             break;
    //     }

    //     array_push($this->data['menuRoutes'],
    //             array('name' => 'Perfil','path' => base_url('backoffice/users')),
    //             array('name' => 'Consultas','path' => base_url('backoffice/consultas')),
    //             array('name' => 'Logout','path' => base_url('logout')),
    //     );
        
    //     $this->{$table.'_model'}->get
    //     $this->data['action'] = base_url('backoffice/'.$table.'/'); // para os forms

    //     $this->data['css'] = base_url("resources/css/backoffice.css");
    //     print_r($this->data['user']);
    //     $this->fileloader->singleView('backoffice/menu',$this->data);
                        
    //     $this->fileloader->singleView('backoffice/'.$table,$this->data);

    //     $this->fileloader->singleView('backoffice/footer');

    // }
}
