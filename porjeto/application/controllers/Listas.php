<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listas extends CI_Controller { // TODO este controler precisa de olhos
	function __construct(){
		parent::__construct();
	}
	public function medicos() 
	{
		$this->loadLista('medicos');
	}
	public function enfermeiros()
	{
		$this->loadLista('enfermeiros');
	}
	public function utentes()
	{
		$this->loadLista('utentes');
	}
	public function consultas()
	{
		$this->loadLista('consultas');
	}

	private function loadLista($list){ // 
		$this->load->model($list.'_model');
		$data = array(
			'title' => 'Lista de '.$list,
			'css' => base_url("resources/css/listas.css"),
		);

		if($list === 'medicos' || $list === 'enfermeiros')
			$data['l'.$list] = $this->{$list . '_model'}->getNameEspecialidade();
		if($list === 'consultas')
			$data['l'.$list] = $this->{$list . '_model'}->getTodaysConsulta();
		if($list === 'utentes')
			$data['l'.$list] = $this->{$list . '_model'}->getNameCidade();
		$this->fileloader->loadView('l'.$list,$data);
	}
}
