<? $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
			<h3>Your file was successfully uploaded!</h3>
			<ul>
				<?=print_r($upload_data);?>
				<a href="<?=base_url('download_upload/'.$upload_data['raw_name'])?>">Download file</a>
			</ul>
		</div>
<? $this->load->view('comuns/footer'); ?>