<?php
use PHPMailer\PHPMailer\PHPMailer;
defined('BASEPATH') OR exit('No direct script access allowed');
define('ADMIN','pguilherme926@gmail.com');
define('ADMIN_NAME','Guilherme Pereira');
define('PASSWORD','rsayaefhqahptbkq');
class Mymailer {
    private $mail;
    // protected $CI;/

    function __construct(){
        $this->mail = new PHPMailer(true);
        // $this->CI = &get_instance();
    }
    public function send($to,$subj,$msg){
        // try{
            $this->Instance($to,$subj,$msg);
        // }
        // catch(Error $err){
        //     // $this->Instance($to,$subj,$msg,true);
        // }
    }
    private function Instance($to,$subj,$msg,$failed = FALSE){
        // if($failed) SE PHPMAILER FALHOU USO O DO CI
        // {
        //     $this->CI->load->library('email');
        //     $this->CI->email->to($to);
        //     $this->CI->email->subject($subj);
        //     $this->CI->email->message($msg);
        //     if ($this->CI->email->send())
        //         return true;
        //     return false;
        // }
        // else
        // {
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
                $mail->Body = $msg;
                $mail->AltBody = 'This is the body in plain text for non-html mail clients';
                $mail->send();
                return true;
            } catch (Exception $th) {
                return false;
            }
        // }
    }
}