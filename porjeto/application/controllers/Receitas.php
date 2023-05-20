<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receitas extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('receitas_model');
		$this->data['css'] = base_url("resources/css/receitas.css");
	}
	public function index()
	{
	}
	public function individual(){ 
		if(!$this->uri->segment(2))
			redirect(base_url().'homepage');
		if(!$this->session->userdata('logged_in'))
			redirect(base_url('homepage'));
		$id = $this->uri->segment(2);
		$receita = $this->receitas_model->getReceitaData($id);
		if(empty($receita)){
			$this->data['error'] = 'A Receita nao existe!';
			$this->fileloader->loadView('receitas/individual',$this->data);
			return;
		}		
		$this->data['title'] = 'Receita individual';
		$this->data['url'] = base_url('');
		$this->data['receita'] = $receita;
		$this->fileloader->loadView('receitas/individual',$this->data);
	}

	public function downloadReceita(){
		$id = $this->uri->segment(2);
		$receita = $this->receitas_model->getReceitaData($id);
		if(empty($receita))
			return;
		$this->load->helper('download');
		// todo talvez usar library para criar pdf file idk
		$name = "receita.txt";
		$data = 
			"Data da consulta: ".$receita['data']." 
			Estado: ".$receita['estado']."
			Cuidado: ".$receita['cuidado']."
			Utente: ".$receita['utente']."
			Medico: ".$receita['medico']."
			Receita: ".$receita['receita']."
			";
		force_download($name,$data);
	}
	public function enviarEmail(){
		if(!$this->session->userdata('logged_in')){ // nunca entra aqui
			return;
		}	
		if(empty($this->session->userdata('user'))){
			redirect(base_url('login'));
		}
		$user = $this->session->userdata('user');
		$id = $this->uri->segment(2);
		$receita = $this->receitas_model->getReceitaData($id);
		if(empty($receita))
			return; // add error message here
		$this->load->library('Mymailer');
		$msg = "
		<!DOCTYPE html>
		<html>
		<body>
			<h1>Ola,este email e da clinica dos ouricos</h1>
			<p>Aqui estao os dados da receita</p>
			<p>Data da consulta: ".$receita['data']." </p>
			<p>Estado: ".$receita['estado']." </p>
			<p>Cuidado: ".$receita['cuidado']." </p>
			<p>Utente: ".$receita['utente']." </p>
			<p>Medico: ".$receita['medico']." </p>
			<p>Receita: ".$receita['receita']." </p>
			<p>Cumprimentos,</p>
			<p>Clinica dos ouricos</p>
		</body>
		</html>
			";
		if($this->mymailer->send($user[0]->email,"Receita",$msg)){
			echo"teste";
			redirect('homepage'); // mandar aviso que foi enviado
		}
	}
}
