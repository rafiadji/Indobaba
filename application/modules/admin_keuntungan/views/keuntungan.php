<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-md-12">
	<form method="POST" action="">
	<div class="panel panel-default">
	<div class="panel-body">
		<div class="form-group">
			<label>Keuntungan UKM</label>
			<input type="text" name="keuntunganukm" value="<?php echo $tampil->KEUNTUNGAN_UKM;?>" class="form-control">
		</div>
		<div class="form-group">
			<label>Keuntungan Penanggung Jawab</label>
			<input type="text" name="keuntunganpj" value="<?php echo $tampil->KEUNTUNGAN_PJ;?>" class="form-control">
		</div>
		<input type="submit" name="simpan" value="Simpan" class="btn btn-default btn-lg">
	</div>
</div>
</form>
</div>