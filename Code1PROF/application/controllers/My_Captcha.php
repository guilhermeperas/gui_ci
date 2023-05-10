<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Captcha extends CI_Controller
{
function __construct()
{
parent::__construct();
}

public function index()
{
    $this->load->view("captcha");
}

public function verificar()
{
    $recaptchaResponse = $this->input->post("g-recaptcha-response");
    //print_r($recaptchaResponse);
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6Lf5g_MlAAAAAHjMerKoeL2N76BdU1fy0wfzmwVW'; //Não pode ser aspas duplas
    $data = array("secret" => $secret, "response" => $recaptchaResponse);
    //Biblioteca interna do php curl -> estabelece uma ligação direta a um servidor php.ini extension:curl
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($curl);
    curl_close($curl);
    $responseStatus = json_decode($response, true);
    if($responseStatus["success"])
    echo "<br>"."sucesso";
    else
    echo "<br>"."erro";
}
}