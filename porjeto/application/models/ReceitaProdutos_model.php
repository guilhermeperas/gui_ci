<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitaprodutos_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'receita_produto';
	}
	function remover($array){
		if(empty($array))
			return false;
		$this->db->where($array);
		return $this->db->delete($this->table);
	}
}
