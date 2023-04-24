<?php $this->load->view('comuns/header'); ?>
	<body><div id="container">
			<div class="inner">
		<h1 class="menu">Menu</h1>
				<nav>
<?php $this->load->view('comuns/menu'); ?>
				</nav>
	</div>
	<? print_r($formErrors);?>
<form method="POST" action="">
	<label for="nome">Nome</label>
		<input id="nome" name="nome" placeholder="Insere o nome" />
	<label for="email">Email</label>
		<input id="email" name="email" placeholder="Insere o email" />
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