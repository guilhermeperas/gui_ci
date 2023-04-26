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
                $configThumbnail['souce_image'] = $data['info_upload']['full_path']; // mudar isto para o seu proprio objeto
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
        }
        $this->load->view("upload", $data);
    }
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
        return $data;

    }
}
