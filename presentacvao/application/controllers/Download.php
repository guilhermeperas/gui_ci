<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('download');
    }
    public function index(){
        $data['title'] = "Download";
        $this->load->view('download', $data);
    }
    public function download_ficheiro(){
        $text = 'Texto muito';
        $name = 'Text.txt';
        force_download($name, $text);
    }
    public function download_imagem(){
        $image_path = '/path/to/image.jpg';
        $name = 'imagem.jpg';
        $image = file_get_contents($image_path);
        force_download($name, $image);
    }
}

?>