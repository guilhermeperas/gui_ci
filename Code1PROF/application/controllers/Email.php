<?php
use PHPMailer\PHPMailer\PHPMailer;
defined('BASEPATH') OR exit('No direct script access allowed');
// constantes da classe
define('ADMIN','pguilherme926@gmail.com');
define('ADMIN_NAME','Guilherme Pereira');
define('PASSWORD','rsayaefhqahptbkq');

class Email extends CI_Controller { 
    private $mail; // criar singleton para instancia do mail.
	function __construct(){
		parent::__construct();
        $this->mail = new PHPMailer(true);
	}
	public function index(){
    	$this->load->view('email');
	}
    public function send($to,$subj,$msg){
        // $this->input->post
        // o prof recomenda fazer um try catch aqui, para usarmos o mailer interno e o externo caso o interno falhe usamos o externo
        $this->Instance($to,$subj,$msg);
    }
    private function Instance($to,$subj,$msg){
        $mail = new PHPMailer(true);
        try {
            // config do mail
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // dominio aqui
            $mail->SMTPAuth = true;
            $mail->SMTPAutoTLS = false;
            $mail->Username = ADMIN;
            $mail->Password = PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            # servidor não controla o certificado
            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true,
                    )
                )
            );
            // recipients
            $mail->setFrom(ADMIN,ADMIN_NAME);
            $mail->AddAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subj;
            $mail->Body = '<b>'.$msg.'</b>';
            $mail->AltBody = 'This is the body in plain text for non-html mail clients';
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $th) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
