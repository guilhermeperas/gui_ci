<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	// raiz/controller/action/param
	// .../index.php/blog/index
	// .../index.php/blog/
	public function index(){
	/* Passagem entre controller e view */
	$data = array('title' => 'Title Blog',
	'heading' => 'My heading!!!!', 'criador' => 'Sérgio Araujo');
/*$this->load->view('comuns/header',$data);
$this->load->view('blogview',$data);
$this->load->view('comuns/footer',$data);*/
$this->load->view('blogview',$data);
	}
	// .../index.php/blog/exemplo
	public function exemplo(){
		echo "Controllers Blog Action Exemplo";
	}
	// .../index.php/blog/exemploseg/id
	public function exseg($id,$value){
		echo "Controllers Blog Action Exemplo".'<br />';
		echo 'Id: '.$id.'<br />';
		echo 'Value: '.$value.'<br />';
	}
	
	public function exsegmentos(){
		$d = $this->uri->segment(0);
		$c = $this->uri->segment(1);
		$a = $this->uri->segment(2);
		$p1 = $this->uri->segment(3);
		$p2 = $this->uri->segment(4);
		echo 'c->'.$c;
		echo ' a->'. $a . ' p->'.$p1;
		echo ' p2->'.$p2;
	}
	
}
