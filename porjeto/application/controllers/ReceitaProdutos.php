<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitaprodutos extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('receitaprodutos_model');
	}
	public function receita(){
		$this->data['receita_id'] = $this->uri->segment(3);
		if(is_null($this->data['receita_id']))
			redirect(base_url().'consultas');
		$this->data['title'] = 'Produtos da receita '.$this->data['receita_id'];
		$this->data['css'] = base_url("resources/css/produtos.css");

		$this->data['produtos'] = $this->receitaprodutos_model->getProdutosReceita($this->data['receita_id']);
		if($this->data['user']['tipo'] != 'utente' || $this->data['user']['tipo'] != 'rececionista'){
			$this->data['remover'] = base_url().'produtos/remover/';
			$this->data['addProduto'] = base_url().'produtos/produtoList/'.$this->data['receita_id'];
		}
		$this->data['hasPerms'] = $this->data['user']['tipo'] === 'utente' ? false : true;
		$this->data['caminho'] = base_url().'uploads/produtos/';
		$this->loadView('produtos/produtos_receita',$this->data);
	}
	public function removeProdutoFromReceita(){
		// 1 id e da receita 2 e do produto
		$receita_id = $this->uri->segment(3);
		if(is_null($receita_id))
			redirect(base_url().'consultas');
		$produto_id = $this->uri->segment(4);
		if(is_null($produto_id))
			redirect(base_url().'receita'.$receita_id);
		$values = array(
			'id_receita' => $receita_id,
			'id_produto' => $produto_id,
		);
		if($this->receitaprodutos_model->remover($values))
			redirect(base_url().'produtos/receita/'.$receita_id);
	}
	public function addProdutoToReceita(){
		$receita_id = $this->uri->segment(3);
		if(is_null($receita_id))
			redirect(base_url().'consultas');
		$this->form_validation->set_rules('produto','Produto','required');
		if(!$this->form_validation->run() && empty($this->input->post()))
			redirect(base_url().'receita/'.$receita_id);
		$produto_id = $this->input->post('produto'); // TODO GET ESTE VALUE
		$data = array(
			'id_receita' => $receita_id,
			'id_produto' => $produto_id
		);
		$this->receitaprodutos_model->create($data);
		redirect(base_url().'produtos/receita/'.$receita_id);
	}
}
