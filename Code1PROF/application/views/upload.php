<?php $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
			<div class="inner">
				<h1 class="menu">Menu</h1>
				<nav>
					<?php $this->load->view('comuns/menu'); ?>
				</nav>
			</div>
            <div>
                <!-- 
                    EXEMPLO UPLOAD
                    PARA FUNCIONAR É PRECISO ATIVAR A EXTENSÃO GD NO php.ini
                -->
                <form action="<?=base_url('baseupload/upload')?>" method="POST" enctype="multipart/form-data">
                    <label>
                        <input type="file" name="image"/>
                        <input type="submit" value="Processar"/>
                    </label>
                </form>
            </div>
		</div>	
<?php $this->load->view('comuns/footer'); ?>