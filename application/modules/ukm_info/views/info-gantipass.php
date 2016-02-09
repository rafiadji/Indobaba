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
<div class="panel panel-default">
	<div class="panel-body">
		<form method="POST">
		<div class="panel-group">
			<label>Password Lama</label>
			<input type="password" name="passlama" class="form-control" value="">
		</div>
		<div class="panel-group">
			<label>Password Baru</label>
			<input type="password" name="passbaru" class="form-control" value="">
		</div>
		<div class="panel-group">
			<label>Ulangi Password Baru</label>
			<input type="password" name="passbaruulangi" class="form-control" value="">
		</div>

    </form>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<input type="submit" name="simpan" class="btn btn-default btn-lg" value="Simpan">
	</div>
</div>
</div>