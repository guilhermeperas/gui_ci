<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PseudoVariables extends CI_Controller { 
    
    function __construct(){
        parent::__construct();

        $this->load->library(array('pagination','parser')); // parser -> pseudovariaveis interna do CI
    }
    
    public function index(){
        $data = array(
            'h3_string' => 'Paginação',
            'p_string' => 'Olá parser em CI',
            'list_clients' => array(
                array(
                    'id' => 1,
                    'nome' => 'Jorge',
                    'email' => 'jorge@jorge'
                ),
                array(
                    'id' => 2,
                    'nome' => 'Gui',
                    'email' => 'gui@gui'
                ),
                array(
                    'id' => 3,
                    'nome' => 'abreu',
                    'email' => 'abreu@abreu'
                ),
            )
        );
        $data['title'] = "Pseudo Variables";
        $this->parser->parse('pseudovariables',$data);
    }
    public function exemplo1(){
        // pratica errada devia estar num modelo
        $query = $this->db->query("SELECT * FROM users");
         $data = array(
            'h3_string' => 'Paginação',
            'p_string' => 'Olá parser em CI',
            'list_users' => $query->result_array()
        );
        $data['title'] = "Pseudo Variables";
        $this->parser->parse('pseudovariables1',$data);
    }
    public function exemplo2(){
        /**
         * Usar o método parse_string() -> html parse_string(o template a renderizar, o info a ser subs,boolean isto é se querem controlar a renderização ou não)
         */
        $li_listaUsers = "<li>{id} - {nome} - {morada}</li>";
        $query = $this->db->query("SELECT * FROM users");
        $listaUsers = $query->result_array();
        $listaContatos = "<ul>";
        foreach($listaUsers as $user)
            $listaContatos .= $this->parser->parse_string($li_listaUsers,$user,TRUE);
        $listaContatos .= "</ul>";
        $data['list_users_h'] = 'Titulo da lista';
        $data['list_users_h'] = $listaContatos;
        $this->parser->parse('pseudovariables2',$data);

    }
}