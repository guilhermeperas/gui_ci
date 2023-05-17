<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileLoader {
    private $m;
    function __construct(){
        $loader = new Mustache_Loader_FilesystemLoader('./templates');
        $this->m = new Mustache_Engine(['loader' => $loader]);
    }
    public function loadView($view,$values){ // TODO cheka isto bro
        $headerValues = array(
            'css' => $values['css'],
            'title' => $values['title'],
        );
        echo $this->m->render('common/header',$headerValues);
        // TODO proprio file para isto? provavel
        $menuValues = array(
            'menuRoutes' => array(
                array('name' => 'Home','path' => base_url('home')),
                array('name' => 'Login','path' => base_url('Login')),
            ),
        );
        echo $this->m->render('common/menu',$menuValues);

        echo $this->m->render($view,$values);

        echo $this->m->render('common/footer');
    }
}