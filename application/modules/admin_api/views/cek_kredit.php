<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
	<?php endif; ?>
	<?php $i = base64_encode_fix($id); ?>
<form action="<?php echo base_url('admin_api/updateApi/'.$i); ?>" method="POST">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<a href="<?php echo base_url('admin_api'); ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-info-circle"></i> Cek Kredit Api</h4>
			<hr />
			<div class="form-group">
				<label>Sisa Kredit &nbsp;:&nbsp; </label>
				<?php 
				$setting = explode("#", $tampil->SETTING);
				$myxml=simplexml_load_file($tampil->LINK_KREDIT."userkey=".$setting[0]."&passkey=".$setting[1]); 
				echo $myxml->message[0]->value; ?>
			</div>
			<div class="form-group">
				<label>Masa Aktif &nbsp;:&nbsp; </label>
				<?php echo $myxml->message[0]->text; ?>
			</div>
		</div>
	</div>
</div>
</form>