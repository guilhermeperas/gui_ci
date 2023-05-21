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
    public function loadView($view,$values = null,$menuVisible = TRUE){ // TODO cheka isto bro
        $headerValues = array(
            'main_css' =>base_url("resources/css/main.css"),
            'css' => $values && array_key_exists('css',$values) ? $values['css'] : null,
            'title' => $values && array_key_exists('title',$values) ? $values['title'] : $view,
        );
        echo $this->m->render('common/header',$headerValues);

        if($menuVisible)
            echo $this->m->render('common/menu',$this->ci->config->config['menu']);

        echo $this->m->render($view,$values);
        
        if($menuVisible)
            echo $this->m->render('common/footer',$this->ci->config->config['footer']);
    }
}