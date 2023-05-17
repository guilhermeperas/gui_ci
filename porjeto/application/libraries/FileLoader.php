<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileLoader {
    private $m;
    private $config;
    function __construct(){
        $loader = new Mustache_Loader_FilesystemLoader('./templates');
        $this->m = new Mustache_Engine(['loader' => $loader]);
        $this->config = array(
            'menu' => array(
                'menuRoutes' => array(
                    array('name' => 'Home','path' => base_url('home')),
                    array('name' => 'Medicos','path' => base_url('medicos')),
                    array('name' => 'Utentes','path' => base_url('utentes')),
                    array('name' => 'Enfermeiros','path' => base_url('enfermeiros')),
                    array('name' => 'Consultas','path' => base_url('consultas')),
                    array('name' => 'Login','path' => base_url('Login')),
                ),
            ),
            'footer' => array(
                'a_path' => base_url('Contact'),
            ),
        );
    }
    public function loadView($view,$values,$menuVisible = TRUE){ // TODO cheka isto bro
        $headerValues = array(
            'css' => $values['css'],
            'title' => $values['title'],
        );
        echo $this->m->render('common/header',$headerValues);

        if($menuVisible)
            echo $this->m->render('common/menu',$this->config['menu']);

        echo $this->m->render($view,$values);
        
        if($menuVisible)
            echo $this->m->render('common/footer',$this->config['footer']);
    }
}