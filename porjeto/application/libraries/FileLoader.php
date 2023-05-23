<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileLoader {
    private $m;
    private $config;
    function __construct(){
        $loader = new Mustache_Loader_FilesystemLoader('./templates');
        $this->m = new Mustache_Engine(['loader' => $loader]);

        // todo verificar como fazer isto
        $this->ci =& get_instance();
        $this->ci->config->load('fileLoader');
        // mt estranho
    }
    public function loadView($view,$values = null){ 
        $headerValues = array(
            'main_css' =>base_url("resources/css/main.css"),
            'css' => $values && array_key_exists('css',$values) ? $values['css'] : null,
            'title' => $values && array_key_exists('title',$values) ? $values['title'] : $view,
        );
        echo $this->m->render('common/header',$headerValues);

        echo $this->m->render('common/menu',$this->ci->config->config['menu']);

        echo $this->m->render($view,$values);
        
        echo $this->m->render('common/footer',$this->ci->config->config['footer']);
    }
    public function loadBackOfficeView($view,$values,$tipo){ // nao deveria existir.......

        switch($tipo){
            case 'admin': 
                $this->data['menuRoutes'] = array(
                    array('name' => 'Users','path' => base_url('backoffice/users')),
                    array('name' => 'Medicos','path' => base_url('backoffice/medicos')),
                    array('name' => 'Enfermeiros','path' => base_url('backoffice/enfermeiros')),
                    array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
                    array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
                    array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
		        );
                break;
                case 'medico':
                case 'enfermeiros':
                    $this->data['menuRoutes'] = array(
                        array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
                        array('name' => 'Receitas','path' => base_url('backoffice/receitas')),
                        array('name' => 'Produtos','path' => base_url('backoffice/produtos')),
		            );
                break;
                case 'utente':
                    $this->data['menuRoutes'] = array();
                    break;
                case 'rececionista':
                    $this->data['menuRoutes'] = array(
                        array('name' => 'Utentes','path' => base_url('backoffice/utentes')),
		            );
                break;
        }

        array_push($this->data['menuRoutes'],
                array('name' => 'Perfil','path' => base_url('backoffice/users')),
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