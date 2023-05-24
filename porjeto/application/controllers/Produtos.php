<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('produtos_model');
	}

	function produtoList(){
		$this->data['title'] ='Adicionar Produto';
		$this->data['css'] = base_url("resources/css/produtos.css");
		$this->data['receita_id'] = $this->uri->segment(3);
		if(is_null($this->data['receita_id']))
			redirect(base_url().'consultas');
		$this->data['allProducts'] = $this->produtos_model->GetAll();
		$this->data['form_action'] =  base_url().'produtos/addProduto/'.$this->data['receita_id'];
		$this->fileloader->loadView('produtos/add_produto',$this->data);
	}
}
