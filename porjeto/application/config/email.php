<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// definido 2 vezes ver isto...
define('ADMIN','pguilherme926@gmail.com');
define('ADMIN_NAME','Guilherme Pereira');
define('PASSWORD','rsayaefhqahptbkq');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] =  587;
$config['smtp_user'] =  ADMIN;
$config['smtp_pass'] =  PASSWORD;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";

?>