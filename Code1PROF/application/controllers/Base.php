<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contatos_model'); 
    }
    
    public function index(){
        $data['title'] = "Contacts page";
        /* se apenas este metodo usar o modelos
    $this->load->model('contatos_model'); */
        $contatos =  $this->contatos_model->GetAll('nome');
        $dados['contatos'] = $this->contatos_model->Modelar($contatos);
        $this->load->view('home_editar',$dados);
    }
    public function Save(){
        $contatos = $this->contatos_model->GetAll('nome');
        $dados['contatos'] =$this->contatos_model->Modelar($contatos);
        
        $validacao = self::Validation();
        if($validacao){
            $contato = $this->input->post();
            $status = $this->contatos_model->Insert($contato);
            if(!$status)
                $this->session->set_flashdata('error', 'Não foi possível inserir o contato.');
             else{
                $this->session->set_flashdata('success', 'Contato inserido com sucesso.');
                redirect('base', 'refresh');
            }
        }else
            $this->session->set_flashdata('error',validation_errors('<p>','</p>'));
        $this->load->view('home_editar',$dados);
    }
    public function Edit(){
        $id = $this->uri->segment(2);
        if(is_null($id))
            redirect('base', 'refresh');
        $dados['contato'] = $this->contatos_model->GetById($id);
        $this->load->view('editar', $dados);
    }
    public function Update(){
        $validacao = self::Validation('update');
        if($validacao){
            $contato = $this->input->post();
            $status = $this->contatos_model->Update($contato['id'], $contato);
            if(!$status){
                $this->session->set_flashdata('error', 'Não atualizado com sucesso.');
                redirect('base', 'refresh');
            }else{
                $this->session->set_flashdata('sucess', 'Contato atualizado com sucesso.');
                redirect('base', 'refresh');
            }
        }
    }
    public function Delete(){
        $id = $this->uri->segment(2);
        if(is_null($id))
            redirect('base', 'refresh');
        $status = $this->contatos_model->Delete($id);
        if(!$status){
            $this->session->set_flashdata('error', 'Não apagado');
            redirect('base', 'refresh');
        }else{
            $this->session->set_flashdata('sucess', 'Contato apagado com sucesso.');
            redirect('base', 'refresh');
        }
    }
    private function Validation($operacao = 'insert'){
        switch($operacao){
            case 'insert':
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['email'] = array('trim', 'required', 'valid_email', 'is_unique[contatos.email]');
                break;
            case 'update':
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
                $rules['email'] = array('trim', 'required', 'valid_email');
                break;
            default:
                $rules['nome'] = array('trim', 'required', 'min_length[3]');
        }
        $this->form_validation->set_rules('nome', 'Nome', $rules['nome']);
        $this->form_validation->set_rules('email', 'Email', $rules['email']);
        return $this->form_validation->run();
    }
    
}