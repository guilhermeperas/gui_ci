<?
/*$this->router->fetch_class() : É responsável por verificar se a
	classe chamada é Raiz.
$this->router->fetch_method(): se existe o metodo na classe.
	*/
?>
<ul class="nav menu-nav">
	<li class="
	<?=($this->router->fetch_class() == 'Raiz' && $this->router->fetch_method() == 'index')? 'active' : null;?>
	"><a href="<?=base_url()?>">Home</a></li>
	<li class="<?=($this->router->fetch_class() == 'Raiz' && $this->router->fetch_method() == 'empresa')? 'active' : null;?>"><a href="<?=base_url('empresa')?>">A Empresa</a></li>
	<li class="">Serviços</li>	
	<li class="">Contatos</li>
	<!-- Para os exemplos de UPLOAD -->
	<li class="<?=($this->router->fetch_class() == 'BaseUpload' && $this->router->fetch_method() == 'upload')? 'active' : null;?>"><a href="<?=base_url('upload')?>">Upload</a></li>
	<li class="<?=($this->router->fetch_class() == 'BaseUpload' && $this->router->fetch_method() == 'clientes')? 'active' : null;?>"><a href="<?=base_url('clientes')?>">Paginacao</a></li>
	<li class="<?=($this->router->fetch_class() == 'BaseUpload' && $this->router->fetch_method() == 'pseudovariables')? 'active' : null;?>"><a href="<?=base_url('pseudovariables')?>">Parser</a></li>
	<li class="">Download</li>	
</ul>
