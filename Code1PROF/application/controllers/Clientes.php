<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller { // criar classe abstrata para uma classe que use o paginador
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('clientes_model');
    }
    
    public function index(){
        $data['title'] = "Clientes";

        $config["base_url"] = base_url()."clientes";
        $config["per_page"] = 2;
        
        // é irrelevante ter esta config
        // $config["uri_segment"] = 2; // na posição 0(page 0), uma vez que, não temos referencia para pagina dará erro no caso do null para valor inteiro.
        $config["total_rows"] = $this->clientes_model->get_count();

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2) ? $this->uri->segment(2) : 0);

        $data["links"] = $this->pagination->create_links();
        
        $data["clientes"] = $this->clientes_model->get_clientes($config["per_page"] , $page);

        $this->load->view('clientes',$data);
    }
}