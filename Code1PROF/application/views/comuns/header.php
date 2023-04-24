<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<title><?=$title?></title>
		<?
		/* Para usar o base_url devemos carregar o URl Helper.
		application/config/autoload.php
		Declarado no construtor do controller
		$this->load->helper('url');
		
		Usando o base_url tenho a raiz para o css
		*/
		?>
		<link href="<?=base_url("resources/css/home.css")?>" rel="stylesheet" />
	</head>
