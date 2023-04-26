<?php $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
            <?
                if(isset($info))
                    echo $info;
            ?>
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
                    </label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="thumbnail">Criar thumbnail 
                        </label>
                    </div>
                    <label>Altura da imagem após redimensionar (em pixels)</label>
                    <input type="number" name="height" class="form-control" />
                    <label>largura da imagem após redimensionar (em pixels)</label>
                    <input type="number" name="width" class="form-control" />
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="ratio">Manter proporção 
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>Rodar Imagem?
                            <select name="rotation" class="form-control">
                                <option value="">Nao Rodar</option>
                                <option value="90">90</option>
                                <option value="180">180</option>
                                <option value="270">270</option>
                                <option value="hor">Horizontal</option>
                                <option value="vrt">Vertical</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-control">

                        <label>
                            <input type="checkbox" name="crop">Recortar Imagem? 
                        </label>
                        
                    </div>
                    <div class="form-control">
                        
                        <label>
                            <input type="checkbox" name="watermark">Marca de Agua? 
                        </label>
                        
                    </div>
                    <input type="submit" value="Processar"/>
                </form>
            </div>
		</div>	
<?php $this->load->view('comuns/footer'); ?>