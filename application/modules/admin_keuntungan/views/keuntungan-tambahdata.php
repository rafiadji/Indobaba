<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" class="form-horizontal">
	<div class="form-group col-md-12">
		<label class="col-md-2 control-label">Nama Kategori</label>
		<div class="col-md-10">
			<input type="text" name="nama_kategori" value="" class="form-control">
		</div>
	</div>
	<div class="form-group col-md-12">
		<input type="submit" name="simpan_kategori" value="Simpan" class="btn btn-primary">
	</div>
</form>