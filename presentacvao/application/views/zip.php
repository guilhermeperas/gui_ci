<? $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
			<div>
				<h2>Basic example</h2>
				<a href="<?=site_url('Zip/create_zip_file')?>">Download zip</a>
			</div>
			<div>
				<h2>Post example</h2>
				<form action="<?=site_url('Zip/create_zip2')?>" method="post">
					<label for="name">Nome do ficheiro:</label>
					<input type="text" id="name" name="name" required>
					<br/>
					<label for="data">Data:</label>
					<textarea id="data" name="data" required></textarea>
					<input type="submit" value="Create Zip">
				</form>
			</div>
			<div>
				<h2>Multiple files example</h2>
				<form action="<?=site_url('Zip/create_zip3')?>" method="post">
					<label for="number">Number of files:</label>
					<input type="number" id="number" name="number" required>
					<input type="submit" value="Create Zip">
				</form>
			</div>
		</div>
<? $this->load->view('comuns/footer'); ?>