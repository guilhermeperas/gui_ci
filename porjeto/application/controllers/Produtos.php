<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends MY_Controller {
	function __construct(){
		parent::__construct();
        $this->load->library('image_lib');
		$this->load->model('produtos_model');
	}

	function backoffice(){
		if(is_null($this->data['user']))
            redirect(base_url().'login');
        $this->data['title'] = "BackOffice Produtos";
        $this->data['base_url'] = base_url();
		$this->data['list'] = $this->produtos_model->GetAll();
        $this->data['h1_text'] = 'Todas os Produtos';
        $this->data['hasPerms'] = $this->data['user']['tipo'] === 'admin' ? true : false;
        $this->data['create_produto'] = base_url().'produto/createProduto';
		$this->data['caminho'] =base_url().'uploads/produtos/';
        $this->loadBackOfficeView('backoffice/produto/produtos',$this->data);
	}
	public function editProduto(){ // TODO ADD UPLOAD HERE AND FIX THIS
        $id = $this->uri->segment(3);
        if(is_null($id))
            redirect(base_url().'backoffice/produtos');
		$this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('value','Valor','required');
        if($this->form_validation->run()){
            $values = array(
                'nome'=> $this->input->post('nome'),
                'value' => $this->input->post('value'),
            );
			if($this->input->post('imagem')){
				// tratamento da imagem
				//$values['img_path'] = null;
			}
            if($this->produtos_model->Update($id,$values))
                redirect(base_url().'backoffice/produtos');
            $this->data['error'] = 'Erro ao atualizar produto';
        }
        $this->data['produto'] = $this->produtos_model->GetById($id);
        $this->data['form_action'] = base_url().'produtos/edit/'.$id;
        $this->loadBackOfficeView('backoffice/produto/editProduto',$this->data);

    }
	public function criarProduto(){
        $this->form_validation->set_rules('nome','Nome','required');
		$this->form_validation->set_rules('value','Valor','required');
    
        if($this->form_validation->run()){
            $config['upload_path'] = './uploads/produtos/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->load->library('upload',$config);
            $this->upload->initialize($config); 
            if($this->upload->do_upload('imagem')){
                $data['info_upload'] = $this->upload->data();
                $thumb = [
                    'image_library'=> 'gd2',
                    'source_image'=> $data['info_upload']['full_path'],
                    'maintain_ratio' => TRUE,
                    'width' => 75,
                    'height' => 50,
                    'create_thumb' => FALSE,
                    'new_image' => "./uploads/produtos/thumbnails/",
                ];
                $img_path = $data['info_upload']['file_name'];
                $this->image_lib->initialize($thumb);
                if($this->image_lib->resize()){
                    $values = array(
                        'nome'=> $this->input->post('nome'),
                        'value' => $this->input->post('value'),
                        'img_path' => $img_path,
                    );
                    if($this->produtos_model->create($values))
                        redirect(base_url().'backoffice/produtos');
                    $this->data['error'] = 'Erro ao criar o produto';
                }
                $this->data['error'] .= 'erro resize';
            }
            $this->data['error'] = $this->upload->display_errors();
        }
        $this->data['form_action'] = base_url().'produto/createProduto';
        $this->loadBackOfficeView('backoffice/produto/createProduto',$this->data);
    }
	function produtoList(){
		$this->data['title'] ='Adicionar Produto';
		$this->data['css'] = base_url("resources/css/produtos.css");
		$this->data['receita_id'] = $this->uri->segment(3);
		if(is_null($this->data['receita_id']))
			redirect(base_url().'consultas');
		$this->data['allList'] = $this->produtos_model->GetAll();
		$this->data['label'] = 'Adicionar Produto';
        $this->data['selectName'] = "produto";
		$this->data['form_action'] =  base_url().'produtos/addProduto/'.$this->data['receita_id'];
		$this->loadView('mixed/add_something',$this->data);
	}
}
