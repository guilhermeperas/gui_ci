<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'produto';
	}
    function getProdutosReceita($id){
		$this->db->join('receita_produto', 'receita_produto.id_produto = produto.id', 'inner');
		$this->db->where('receita_produto.id_receita', $id);
		$query= $this->db->get($this->table);
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return null;
    }
}
