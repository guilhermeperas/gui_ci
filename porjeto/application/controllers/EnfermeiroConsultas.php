<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enfermeiroconsultas extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('enfermeiroconsulta_model');
	}
	function listEnfermeiro(){
		$this->data['consulta_id'] = $this->uri->segment(3);
		if(is_null($this->data['consulta_id']))
			redirect(base_url().'consultas');
		$this->data['title'] = 'Enfermeiros na consulta  '.$this->data['consulta_id'];
		$this->data['css'] = base_url("resources/css/enfermeiros.css");
		$this->data['enfermeiros'] = $this->enfermeiroconsulta_model->getEnfermeirosConsulta($this->data['consulta_id']);
		if($this->data['user']['tipo'] == 'medico'){ // TODO QUEM PODE ATRIBUIR ENFERMEIROS PARA A CONSULTA?
			$this->data['remover'] = base_url().'enfermeiros/remover/';
			$this->data['addEnfermeiro'] = base_url().'enfermeiros/enfermeiroList/'.$this->data['consulta_id'];
		}
		$this->data['hasPerms'] = $this->data['user']['tipo'] != 'admin' ? false : true;
		$this->loadView('enfermeiros/enfermeiro_consulta',$this->data);
	}
	public function removeEnfermeiroFromConsulta(){
		// 1 id e da consulta 2 e do enfermeiro
		$consulta = $this->uri->segment(3);
		if(is_null($consulta))
			redirect(base_url().'consultas');
		$enfermeiro_id = $this->uri->segment(4);
		if(is_null($enfermeiro_id))
			redirect(base_url().'consultas');
		$values = array(
			'id_enfermeiro' => $enfermeiro_id,
			'id_consulta' => $consulta,
		);
		if($this->enfermeiroconsulta_model->remover($values))
			redirect(base_url().'produtos/receita/'.$receita_id);
	}
	public function addEnfermeiroToConsulta(){
		$consulta_id = $this->uri->segment(3);
		if(is_null($consulta_id))
			redirect(base_url().'consultas');
		$this->form_validation->set_rules('enfermeiro','Enfermeiro','required');
		if(!$this->form_validation->run() && empty($this->input->post()))
			redirect(base_url().'receita/'.$consulta_id);
		$enfermeiro_id = $this->input->post('produto'); // TODO GET ESTE VALUE
		$data = array(
			'id_enfermeiro' => $enfermeiro_id,
			'id_consulta' => $consulta_id
		);
		$this->enfermeiroconsulta_model->create($data);
		redirect(base_url().'produtos/receita/'.$receita_id);
	}
}
