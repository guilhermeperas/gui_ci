<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller {
    protected $data = array(
        'css' => null,
        'title' => null,
    );
    private $page;
    private $per_page;
	function __construct(){
		parent::__construct();
        $this->data['user'] = $this->session->userdata('user');
	}
    protected function initialize($config){
        $this->load->library('pagination');
        $this->per_page = $config["per_page"];
        $this->pagination->initialize($config);

        $this->page = ($this->uri->segment(2) ? $this->uri->segment(2) : 0); // variavel big boy $this
        $this->data["links"] = $this->pagination->create_links();
    }
    protected function loadLista($name,$logged_in){
        $this->data['css'] = base_url("resources/css/listas.css");
        $this->{$name . '_model'}->initializeLimit($this->per_page , $this->page);
        if($this->session->userdata('logged_in')){
            $this->data["list"] = $this->{$name . '_model'}->getLoggedInList();
            $this->fileloader->loadView('lists/login/l'.$name,$this->data);
            return;
        }
        $this->data["list"] = $this->{$name . '_model'}->getNotLoggedInList();
        $this->fileloader->loadView('lists/logoff/l'.$name,$this->data);
    }
    protected function upload($folder)
    {
        $this->load->library('upload');
        if (!$this->upload->do_upload("imagem")) {
            $data["info"] = $this->upload->display_errors();
        } else {
            $message = "";
            $data['info'] = "Imagem processada com sucesso";
            $data['info_upload'] = $this->upload->data();
            print_r($data);
            return;
            $data['folder'] = $folder;
            $this->setConfig($data);

            $this->optImage("thumb");
        }
        return $data;
    }
    private function optImage($type){
        $this->image_lib->initialize($configMain[$type]);

        if(!$this->image_lib->{($opt == 'thumb') ? 'resize' : $opt}()){
            $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O ".$type." DEVIDO AOS ERROS ABAIXO:<br/>";
            $data['info'] .= $thumbnail['message'];
        }else{
            $data['info_upload']['thumb_path'] = 
                $data['info_upload']['full_path']."/thumbs/".$data['info_upload']['raw_name']."_thumb".$data['info_upload']['file_ext'];
        }
    }
    private function setConfig($fileUpload){
        $this->configMain = [
            "thumb" => [
                'image_library'=> 'gd2',
                'source_image'=> $fileUpload['info_upload']['full_path'],
                'maintain_ratio' => TRUE,
                'width' => 75,
                'height' => 50,
                'create_thumb' => TRUE,
                'new_image' => "./uploads/".$fileUpload['folder']."/",
            ],
        ];
    }
}
