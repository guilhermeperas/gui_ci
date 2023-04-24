<?php $this->load->view('comuns/header'); ?>
	<body><div id="container">
			<div class="inner">
		<h1 class="menu">Menu</h1>
				<nav>
<?php $this->load->view('comuns/menu'); ?>
				</nav>
	</div>
	<? if($formErrors){?>
		<div class="alert alert-danger">
		<?=$formErrors; ?>
		</div>
	<? }else{ 
			if($this->session->flashdata('success_msg')){
				?>
				<div class="alert-success">
<?=$this->session->flashdata('success_msg')?>
				</div>
				<?
			}
	}
	?>
<?
/*
Preenchimento dos campos com os dados passados pelo user.
O metodo set_value()->recupera os dados enviados pelo form, utilizado na view.
O método set_value() tem um parâmetro que é o nome do campo, o mesmo usado no atributo name do input .
*/
?>
<form method="POST" action="">
	<label for="nome">Nome</label>
		<input value="<?=set_value('nome')?>" id="nome" name="nome" placeholder="Insere o nome" />
	<label for="email">Email</label>
		<input value="<?=set_value('email')?>" id="email" name="email" placeholder="Insere o email" />
	<label for="telefone">Telefone</label>
		<input id="telefone" name="telefone" placeholder="Insere o telefone" />
	<label for="assunto">Assunto</label>
		<input id="assunto" name="assunto" placeholder="Insere o assunto" />
	<label for="msg">Msg</label>
		<textarea id="msg" name="msg" rows="5">
		</textarea>
	<input type="submit" value="Enviar" />
</form>
		</div>	
<?php $this->load->view('comuns/footer'); ?>