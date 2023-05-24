<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitaprodutos_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'receita_produto';
	}
	function getProdutosReceita($id){
		$this->db->join('produto', 'receita_produto.id_produto = produto.id', 'inner');
		$this->db->where('receita_produto.id_receita', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return null;
    }
	function remover($array){
		if(empty($array))
			return false;
		$this->db->where($array);
		return $this->db->delete($this->table);
	}
}
