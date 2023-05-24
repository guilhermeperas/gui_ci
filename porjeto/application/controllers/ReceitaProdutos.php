<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitaprodutos extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('receitaprodutos_model');
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
