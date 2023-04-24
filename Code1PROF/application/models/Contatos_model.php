<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contatos_model extends MY_Model {
	function __construct(){
		parent::__construct();
		$this->table = 'contatos';
	}
	
	function Modelar($contatos){
		if($contatos){
for($i = 0; $i < count($contatos); $i++){
	$contatos[$i]['edit_url']= base_url('edit'."/".$contatos[$i]['id']);
	$contatos[$i]['del_url'] = base_url('delete'."/".$contatos[$i]['id']);
			}
			return $contatos;
		}else
			return false;
	}
}
