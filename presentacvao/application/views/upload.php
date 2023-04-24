<? $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
			<?php echo $error?>
			<?php echo form_open_multipart('upload/do_upload');?>
			<input type="file" name="userfile" size="20" /><br />
			<input type="submit" value="Upload" />
			</form>
			<?=base_url('application/uploads')?>
		</div>
<? $this->load->view('comuns/footer'); ?>