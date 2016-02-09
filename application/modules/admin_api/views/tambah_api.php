<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
	<?php endif; ?>
<form action="<?php echo base_url('admin_api/tambahApi'); ?>" method="POST">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Tambah API" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_api'); ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-info-circle"></i> Tambah Api</h4>
			<hr />
			<div class="form-group">
				<label>Deskripsi Api</label>
				<input type="text" class="form-control"  name="des_api"/>
			</div>
			<div class="form-group">
				<label>User Key</label>
				<input type="text" class="form-control"  name="user_key"/>
			</div>
			<div class="form-group">
				<label>Pass Key</label>
				<input type="text" class="form-control"  name="pass_key"/>
			</div>
			<div class="form-group">
				<label>Link</label>
				<input type="text" class="form-control" name="link"/>
			</div>
			<div class="form-group">
				<label>Link Kredit</label>
				<input type="text" class="form-control" name="kredit"/>
			</div>
		</div>
	</div>
</div>
</form>