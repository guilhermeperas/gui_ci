<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('produtos_model');
	}

	public function receita(){
		$this->data['receita_id'] = $this->uri->segment(3);
		if(is_null($this->data['receita_id']))
			redirect(base_url().'consultas');
		$this->data['title'] = 'Produtos da receita '.$this->data['receita_id'];
		$this->data['css'] = base_url("resources/css/produtos.css");

		$this->data['produtos'] = $this->produtos_model->getProdutosReceita($this->data['receita_id']);
		if($this->data['user']['tipo'] != 'utente' || $this->data['user']['tipo'] != 'rececionista'){
			$this->data['remover'] = base_url().'produtos/remover/';
			$this->data['allProducts'] = $this->produtos_model->GetAll();
			$this->data['form_action'] = base_url().'produtos/addProduto/'.$this->data['receita_id'];
		}
		$this->fileloader->loadView('produtos/produtos_receita',$this->data);
	}
}
