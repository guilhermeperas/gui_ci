<?
defined('BASEPATH') OR exit('No direct script access allowed');
$config = array(
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
?>