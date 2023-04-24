<? $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
				<div id="inner">
					<h1 id="menu">Menu</h1>
					<nav>
						<? $this->load->view('comuns/menu'); ?>
					</nav>
				</div>
				<div>
					<h1><?=$title;?></h1>
					<h2><?=$desc;?></h2>
					<div class="alert alert-danger">
						<?= $formErrors; ?>
					</div>
					<!-- É O NATIVO !!!        \/ -->
					<form method="POST" action="">
						<label for="nome">Nome</label>
						<input id="nome" name="nome" placeholder="Incere o nome"/>
						
						<label for="email">Email</label>
						<input id="email" name="email" placeholder="Incere o email"/>

						<label for="telefone">Telefone</label>
						<input id="telefone" name="telefone" placeholder="Incere o telefone"/>

						<label for="assunto">Assunto</label>
						<input id="assunto" name="assunto" placeholder="Incere o assunto"/>

						<label for="msg">Message</label>
						<textarea id="msg" name="msg" rows="5"></textarea>
						<input type="submit" value="Enviar"/>
					</form>
				</div>
			</div>
<? $this->load->view('comuns/footer'); ?>