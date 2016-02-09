<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="<?=base_url()?>admin_user/tambahAdminsubmit">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Tambah Admin" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_user/') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="USERNAME" class="form-control"/>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="PASSWORD" class="form-control"/>
			</div>
			<div class="form-group">
				<label>Ulangi Password</label>
				<input type="password" name="PASSWORD2" class="form-control"/>
			</div>
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="NAMA" class="form-control"/>
			</div>
			<div class="form-group">
				<label>No Telepon</label>
				<input type="text" name="NO_TELP" class="form-control"/>
			</div>
		</div>
	</div>
</div>
</form>