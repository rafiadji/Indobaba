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
		<input type="submit" name="simpan" class="btn btn-default btn-lg" value="Simpan">
		<a href="<?php echo base_url('admin_slider') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control" value="<?php echo $tampil->NAMA_SLIDER;?>">
			</div>
			<div class="form-group">
				<label>File</label>
				<input type="text" name="nama" class="form-control" value="<?php echo $tampil->NAMA_SLIDER;?>">
			</div>
			<div class="form-group">
				<label>Status</label><br />
				<input type="radio" name="status" value="1" <?php if($tampil->STATUS_VALID == 1){ echo "checked";}?>>&nbsp;&nbsp;Terbitkan & Simpan&nbsp;&nbsp;<input type="radio" name="status" value="0"<?php if($tampil->STATUS_VALID == 0){ echo "checked";}?>>&nbsp;&nbsp;Draft
			</div>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<img class="img-responsive img-thumbnail" src="<?php echo base_url();?>assets/images/slider/<?php echo $tampil->FT_SLIDER;?>">
		</div>
	</div>
</div>
<?php echo form_close();?>