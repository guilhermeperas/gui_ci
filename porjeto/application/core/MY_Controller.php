<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {
    protected $data = array(
        'css' => null,
        'title' => null,
    );
    private $page;
    private $per_page;
    private $m;
	function __construct(){
		parent::__construct();

        $loader = new Mustache_Loader_FilesystemLoader('./templates');
        $this->m = new Mustache_Engine(['loader' => $loader]);
        $this->config->load('fileLoader');

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
            $this->loadView('lists/login/l'.$name,$this->data);
            return;
        }
        $this->data["list"] = $this->{$name . '_model'}->getNotLoggedInList();
        $this->loadView('lists/logoff/l'.$name,$this->data);
    }
    function loadView($view,$values = null){
        $headerValues = array(
            'main_css' =>base_url("resources/css/main.css"),
            'css' => $values && array_key_exists('css',$values) ? $values['css'] : null,
            'title' => $values && array_key_exists('title',$values) ? $values['title'] : $view,
        );
        echo $this->m->render('common/header',$headerValues);

        echo $this->m->render('common/menu',$this->config->config['menu']);

        echo $this->m->render($view,$values);
        
        echo $this->m->render('common/footer',$this->config->config['footer']);
    }
    function loadBackOfficeView($view,$values){ 
        if(is_null($this->data['user']))
            redirect(base_url().'login');
        $this->data['menuRoutes'] = array();
        if($this->data['user']['tipo'] === 'admin'){
                $this->data['menuRoutes'] = array(
                    array('name' => 'Users','path' => base_url('backoffice/users')),
                    array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
		        );
        }
        if($this->data['user']['tipo']!== 'utente'){
            array_push($this->data['menuRoutes'],array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
            array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
            );
        }
        array_push($this->data['menuRoutes'],
                array('name' => 'Perfil','path' => base_url('backoffice/users')),
                array('name' => 'Medicos','path' => base_url('backoffice/medicos')),
                array('name' => 'Enfermeiros','path' => base_url('backoffice/enfermeiros')),
                array('name' => 'Consultas','path' => base_url('backoffice/consultas')),
                array('name' => 'Logout','path' => base_url('logout')),
            );
        $this->data['title'] = 'BackOffice';
        $this->data['css'] = base_url("resources/css/backoffice.css");

        echo $this->m->render('backoffice/menu',$this->data);
                        
        echo $this->m->render($view,$values);

        echo $this->m->render('backoffice/footer');
    }
    public function singleView($view,$data = null){
        $headerValues = array(
            'main_css' =>base_url("resources/css/main.css"),
            'css' => $data && array_key_exists('css',$data) ? $data['css'] : null,
            'title' => $data && array_key_exists('title',$data) ? $data['title'] : $view,
        );
        echo $this->m->render('common/header',$headerValues);

        echo $this->m->render($view,$data);
    }
}
