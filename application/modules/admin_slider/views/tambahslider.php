<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<?php echo form_open_multipart();?>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" class="btn btn-default btn-lg" name="simpan" value="Simpan">
			<a href="<?php echo base_url('admin_slider/') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control">
			</div>
			<div class="form-group">
				<label>File</label>
				<input type="file" name="userfile" class="form-control">
			</div>
			<div class="form-group">
				<label>Status</label><br />
				<input type="radio" name="status" value="1" checked>&nbsp;&nbsp;Terbitkan & Simpan&nbsp;&nbsp;<input type="radio" name="status" value="0">&nbsp;&nbsp;Draft
			</div>
			
		</div>
	</div>
</div>
