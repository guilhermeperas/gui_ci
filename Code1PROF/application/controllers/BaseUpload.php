<?php
defined("BASEPATH") or exit("No direct script access allowed");

class BaseUpload extends CI_Controller
{
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
            // upload->data() -> info do upload
            $data["info_upload"] = $this->upload->data(); // new MyUpload($this->upload->data();) // devera ter uma classe abstrata 

            // criar thumbnail
            /*
             * $_POST['thumbnail'] -> nativo
             * $this->input->post('thumbnail') -> codeigniter
            */
            // basicamente com o objeto upload faziamos 
            if($this->input->post('thumbnail')){ 
                // $mythumbnail = $Upload_Thumbnain->setupThumbnail($this->input->post('thumbnail'))
                $configThumbnail['source_image'] = $data['info_upload']['full_path']; // mudar isto para o seu proprio objeto
                // define a largura da thumbnail
                $configThumbnail['maintain_ratio'] = TRUE;  
                // se o $configThumbnail['maintain_ratio'] for definido como TRUE, ELE ESCOLHE O MENOR VALOR ENTRE ALTURA E LARGURA
                // largura da thumbnail
                $configThumbnail['width'] = 75;
                // altura da thumb
                $configThumbnail['height'] = 75;
                
                $thumbnail = $this->generateThumbnail($configThumbnail);

                if(!$thumbnail['status']){
                    $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O THUMBNAIL DEVIDO AOS ERROS ABAIXO:<br/>";
                    $data['info'] .= $thumbnail['message'];
                }else{
                    $data['info_upload']['thumb_path'] = 
                        $data['info_upload']['full_path']."/thumbs/".$data['info_upload']['raw_name']."_thumb".$data['info_upload']['file_ext'];
                }
            }
            if($this->input->post('width') || $this->input->post('height') ){
                $configResize['source_image'] = $data['info_upload']['full_path'];
                $configResize['maintain_ratio'] = ($this->input->post('ratio')) ? TRUE : FALSE;
                $configResize['width'] =  ($this->input->post('width')) ? $this->input->post('width') : null;
                $configResize['height'] =  ($this->input->post('height')) ? $this->input->post('height') : null;

                $resize = $this->ResizeImage($configResize);
                if(!$resize['status']){
                    $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O resize DEVIDO AOS ERROS ABAIXO:<br/>";
                    $data['info'] .= $resize['message'];
                }else{
                    $data['info_upload']['thumb_path'] = 
                        $data['info_upload']['full_path']."/resized/".$data['info_upload']['raw_name']."_resize".$data['info_upload']['file_ext'];
                }
            }
            if($this->input->post('rotation')){
                $configRotation['source_image'] = $data['info_upload']['full_path'];
                $configRotation['rotation_angle'] = $this->input->post('rotation');

                $rotate = $this->RotateImage($configRotation);
                if(!$rotate['status']){
                    $data['info'] = "<br/> NÃO FOI POSSIVEL GERAR O rotate DEVIDO AOS ERROS ABAIXO:<br/>";
                    $data['info'] .= $rotate['message'];
                }else{
                    $data['info_upload']['thumb_path'] = 
                        $data['info_upload']['full_path']."/rotated/".$data['info_upload']['raw_name']."_rotated".$data['info_upload']['file_ext'];
                }
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
    // estas funções podem ser so uma
    private function generateThumbnail($config){
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = TRUE;
        $config['new_image'] = "./uploads/thumbs/"; // tem de ser dinamico

        $this->image_lib->initialize($config);

        if($this->image_lib->resize()){
            $data['status'] = true;
            $data['message'] = null;
        }else{
            $data['status'] = false;
            $data['message'] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
        return $data;
    }
    private function ResizeImage($config){
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = FALSE;
        $config['new_image'] = "./uploads/resized/";

        $this->image_lib->initialize($config);

        if($this->image_lib->resize()){
            $data['status'] = true;
            $data['message'] = null;
        }else{
            $data['status'] = false;
            $data['message'] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
        return $data;
    }
    private function RotateImage($config){
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = FALSE;
        $config['new_image'] = "./uploads/rotated/"; // tem de ser dinamico

        $this->image_lib->initialize($config);
        if($this->image_lib->rotate()){
            $data['status'] = true;
            $data['message'] = null;
        }else{
            $data['status'] = false;
            $data['message'] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
        return $data;
    }
    private function CropImage($config,$data){
        $config['image_library'] = 'gd2';
        $config['new_image'] = "./uploads/croped/"; // tem de ser dinamico
        $config['width'] = $data['info_upload']['image_width'] / 2; // dividimos a imagem a metade 
        $config['height'] = $data['info_upload']['image_height'] / 2;

        $config['x_axis'] = round($config['width'] / 2);
        $config['y_axis'] = round($config['height'] / 2);

        $this->image_lib->initialize($config);
        if($this->image_lib->crop()){
            $data['status'] = true;
            $data['message'] = null;
        }else{
            $data['status'] = false;
            $data['message'] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
        return $data;
    }
    private function ApplyWatermark($config){
        $config['image_library'] = 'gd2';
        $config['new_image'] = "./uploads/WM/"; // tem de ser dinamico

        $config['wm_type'] = 'overlay';
        $config['wm_opacity'] = '50';
        $config['wm_overlay_path'] = './assets/images/watermark.png'; // 


        $this->image_lib->initialize($config);
        if($this->image_lib->watermark()){
            $data['status'] = true;
            $data['message'] = null;
        }else{
            $data['status'] = false;
            $data['message'] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
        return $data;
    }
        // -----------------------------------------
}
