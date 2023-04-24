<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Zip extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->library('zip');
        $this->zip->compression_level = 4;
    }
    public function index(){
        $data['title'] = "Zip";
        $this->load->view('zip', $data);
    }

    public function create_zip_file() {
        $name = 'ficheiro';
        $data = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc gravida dui eget suscipit hendrerit. Ut tincidunt imperdiet ornare. Etiam feugiat turpis orci, ut dignissim ligula vulputate et. Aenean feugiat eleifend euismod. Phasellus facilisis purus sit amet consequat ultricies. Morbi tempus mi nulla, non efficitur ante maximus non. Aenean vel ante venenatis sapien imperdiet sagittis. Nam et porta nisl, a ultricies nulla. Sed ornare turpis purus, id dapibus ipsum suscipit ut. Nunc ac cursus dui, quis vehicula ipsum.';
        $this->zip->add_data($name.'.txt', $data);
        $this->zip->archive(FCPATH . 'application/archive/'.$name.'.zip');
        $this->zip->download($name.'.zip');
    }
    public function create_zip2(){
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $data_to_zip = $this->input->post('data');
            
            $this->zip->add_data('textfile.txt', $data_to_zip);
            $this->zip->archive($name.'.zip');
            $this->zip->download($name.'.zip');
        }
    }
    public function create_zip3(){
        if ($this->input->post()) {
            $numero = $this->input->post('number');
            if($numero < 0) return null;
            for($i = 0; $i < $numero ; $i++)
                $this->zip->add_data('textfile.txt', 'extrato de conta');
            $this->zip->archive(FCPATH . 'application/archive/'.$name.'.zip');
            $this->zip->download($name.'.zip');
        } 
    }
    public function download_upload($name){
        $upload_path = base_url('application/uploads');
        $this->zip->read_dir($upload_path);
        $this->zip->read_file($upload_path.'/'.$name);
        $this->zip->download($name.'.zip');
    }
}

?>