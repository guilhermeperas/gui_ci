<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato_new extends CI_Controller {
	/*
	Após a submissão de um formulário as mensagens geradas são apenas temporárias.
	Para tornar qualquer informação permanente devemos usar a library Session, nativa do CI.
	Sessions do tipo flashdata-> representam carregamento por impulso, isto é, ao mudar de página ou recarregando a página automaticamente são excluidas de memória.
	*/
	function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','session'));
	$this->load->helper(array('form','url'));
	}
	public function index(){
		$data['title'] = "Contact page";
		$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
		$this->form_validation->set_rules('telefone', 'Telefone', 'required|numeric');
		if($this->form_validation->run() == FALSE){
			$data['formErrors'] = validation_errors();
		}else{
			$this->session->set_flashdata('success_msg', 'Contato processado com sucesso!');
			$data['formErrors'] = null;
			// Rotina de BD
		}
	$this->load->view('contato_new',$data);
	}
}
