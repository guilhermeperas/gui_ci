<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseO extends CI_Controller { // Controller upload otimizado
    private $configMain = array();
	function __construct(){
		parent::__construct();
	}
	public function index(){
        $data["title"] = "Page - Home";
    	$this->load->view('upload',$data);
	}
    private function Upload()
    {
        $data["title"] = "Page - Upload";
        if (!$this->upload->do_upload("image")) {
            $data["info"] = $this->upload->display_errors();
        } else {
            $message = "";
            $data['info'] = "Imagem processada com sucesso";
            $data['info_upload'] = $this->upload->data();
    
            $this->setConfig($data);

            // por em 1 linha
            if($this->input->post('thumbnail')){
                $messageType .= "gerar o thumbnail";
                $this->optImage("thumb");
            }
            if($this->input->post('width') || $this->input->post('height') ){
                $messageType .= "gerar o resize";
                $this->optImage("resize");
            }
            if($this->input->post('rotation')){
                $messageType .= "gerar o rotate";
                $this->optImage("rotate");
            }
            if($this->input->post('crop')){
                $messageType .= "gerar o crop";
                $this->optImage("crop");
            }
            if($this->input->post('watermark')){
                $messageType .= "gerar o watermark";
                $this->optImage("watermark");
            }
        }
        $this->load->view('upload',$data);
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
                'new_image' => "./uploads/thumbs/",
            ],
            "resize" => [
                'image_library'=> 'gd2',
                'source_image'=> $fileUpload['info_upload']['full_path'],
                'maintain_ratio' => FALSE,
                'new_image' => "./uploads/resized/",
                'width' =>  ($this->input->post('width')) ? $this->input->post('width') : null,
                'height' =>  ($this->input->post('height')) ? $this->input->post('height') : null,


            ],
            "rotate" => [
                'image_library'=> 'gd2',
                'souce_image' => $fileUpload['info_upload']['full_path'],
                'rotation_angle' => $this->input->post('rotation'),
                'new_image' => "./uploads/rotated/",
            ],
            "crop" => [
                'image_library'=> 'gd2',
                'souce_image' => $fileUpload['info_upload']['full_path'],
                'new_image' => "./uploads/croped/",
                'width' => $fileUpload['info_upload']['image_width'] / 2,
                'height' => $fileUpload['info_upload']['image_height'] / 2,
                'x_axis' => round($this->configMain['width'] / 2),
                'y_axis' => round($this->configMain['height'] / 2),
            ],
            "watermark" => [
                'image_library'=> 'gd2',
                'souce_image' => $fileUpload['info_upload']['full_path'],
                'new_image' => "./uploads/WM/",
                'wm_type' => 'overlay',
                'wm_opacity' => '50',
                'wm_overlay_path' => './assets/images/watermark.png',
            ],
        ];
    }
}
