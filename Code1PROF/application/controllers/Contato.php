<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {
	/*
	Para validar um formulário, será usada a library Form_Validation, nativa do CI. 
	O helper Form , vai permitir montar os formulários usando métodos nativos do CI.
	Podem incluir no autoload;
	mas uma vez que usamos apenas nos forms de contato, devemos incluir 
	via construct ou diretamtene no metodo.
	*/
	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	$this->load->helper(array('form','url'));
	}
	
	// .../index.php/Contato/index
	// ...contato
	public function index(){
		$data['title'] = "Contact page";
		/*Sintaxe: 
$this->form_validation->set_rules(nome, descricao, regras);
nome-> name no input
descricao->  msg a exibir
regra:
	required_> obrigatório
	min_length[3]-> cara. min
	trim-> espaços em branco antes e depois do valor do campo;
*/
		$this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
		$this->form_validation->set_rules('telefone', 'Telefone', 'required|numeric');
		if($this->form_validation->run() == FALSE){
			/*validation_errors() ─ método responsável por recuperar as mensagens geradas pelas regras de validação que foram processadas com a instrução  */
			$data['formErrors'] = validation_errors();
			/*
			Diretamente a na vista
<?=validation_errors('<div class="alert">','</div>'); ?>
			*/
		}else
			$data['formErrors'] = null;
	$this->load->view('contato',$data);
	}
}
