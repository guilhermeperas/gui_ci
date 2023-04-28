<?php
defined("BASEPATH") or exit("No direct script access allowed");

class BaseUpload extends CI_Controller
{
    private $data;
    private $config = array (
        "thumbnail" => array(
            'maintain_ratio' => TRUE,
            'height' => 75,
            'width' => 75,
        ),
        "resize" => array(
            "create_thumb" => TRUE,
        ),
        "rotate" => array(
        ),
        "crop" => array(
            "width" => $data['info_upload']['image_width'] / 2,
            "height" => $data['info_upload']['image_height'] / 2,
            'x_axis' => round($config['width'] / 2),
            'y_axis' => round($config['height'] / 2),
        ),
        "watermark" => array(
            'wm_type' => 'overlay',
            'wm_opacity' => '50',
            'wm_overlay_path' => './assets/images/watermark.png',
        ),
    );
    function __construct()
    {
        parent::__construct();
        $this->load->library(["image_lib", "upload"]);
    }
    public function index()
    {
        $data["title"] = "Page - Home";
        $this->load->view("upload", $data);
    }
    
    public function Upload()
    {
        $data["title"] = "Page - Upload";
        // $this-> image_lib -> chamada a bib.
        // upload->do_upload('valor do post');
        
        if (!$this->upload->do_upload("image")) {
            $data["info"] = $this->upload->display_errors();
        } else {
            $this->data["info_upload"] = $this->upload->data(); 
                $config['source_image'] = $data['info_upload']['full_path'];
                
            if($this->input->post('thumbnail'))
                $this->generateImage(array($this->config->thumbnail,$config),"resize");

            if($this->input->post('width') || $this->input->post('height') ){
                
                $configResize['maintain_ratio'] = ($this->input->post('ratio')) ? TRUE : FALSE;
                $configResize['width'] =  ($this->input->post('width')) ? $this->input->post('width') : null;
                $configResize['height'] =  ($this->input->post('height')) ? $this->input->post('height') : null;
                
                $this->generateImage(array($configResize,$config),"resize");
            }
            if($this->input->post('rotation')){
                $configRotation['source_image'] = $data['info_upload']['full_path'];
                $configRotation['rotation_angle'] = $this->input->post('rotation');
                
                $this->generateImage(array($configRotation,$config),"rotate");
            }
            if($this->input->post('crop')){
                $configCrop['source_image'] = $data['info_upload']['full_path'];
                
                $crop = $this->CropImage($configCrop,$data);
                if(!$crop['status']){
                    $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O crop DEVIDO AOS ERROS ABAIXO:<br/>";
                    $data['info'] .= $crop['message'];
                }else{
                    $data['info_upload']['thumb_path'] = 
                    $data['info_upload']['full_path']."/croped/".$data['info_upload']['raw_name']."_crop".$data['info_upload']['file_ext'];
                }
            }
            if($this->input->post('watermark')){
                $confgWM['source_image'] = $data['info_upload']['full_path'];
                
                $WM = $this->ApplyWatermark($confgWM);
                if(!$WM['status']){
                    $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O crop DEVIDO AOS ERROS ABAIXO:<br/>";
                    $data['info'] .= $WM['message'];
                }else{
                    $data['info_upload']['thumb_path'] = 
                    $data['info_upload']['full_path']."/WM/".$data['info_upload']['raw_name']."_wm".$data['info_upload']['file_ext'];
                }
            }
        }
        $this->load->view("upload", $data);
    }
    private function generateImage($config,$action){
        $myconfig['image_library'] = 'gd2';
        $myconfig['new_image'] = "./uploads/".$action."/";
        $myconfig['source_image'] = $data['info_upload']['full_path'];

        $this->image_lib->initialize(array_merge($config,$myconfig));
        
        if($this->image_lib->{$action}()){
            $data['status'] = true;
            $data['message'] = null;
        }else{
            $data['status'] = false;
            $data['message'] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
        return $this->formatData($data,$action);
    }
    private function formatData($data){
        if(!$data['status']){
            $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O ".$action." DEVIDO AOS ERROS ABAIXO:<br/>";
            $data['info'] .= $data['message'];
        }else{
            $data['info_upload']['thumb_path'] = 
            $data['info_upload']['full_path']."/$action/".$data['info_upload']['raw_name']."_wm".$data['info_upload']['file_ext'];
        }
        return $data;
    }
    //     $config['image_library'] = 'gd2';
    //     $config['new_image'] = "./uploads/thumbs/"; // tem de ser dinamico
    // $config['source_image'] = $data['info_upload']['full_path'];

}
