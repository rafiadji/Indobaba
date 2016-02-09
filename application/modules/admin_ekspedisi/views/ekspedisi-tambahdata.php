<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

<?php endif; ?>

<form method="POST" action="">

<div class="col-md-12">

	<div class="panel panel-default">

		<div class="panel-body">

			<div class="form-group">

				<label>Nama Ekspedisi</label>

				<input type="text" name="nama_ekspedisi" value="" class="form-control">

			</div>

			<div class="form-group">

				<label>Deskripsi Ekspedisi</label>

				<textarea name="des_ekspedisi" class="form-control"></textarea>

			</div>

		</div>

	</div>
	<div class="panel panel-default">

		<div class="panel-body">

			<input type="submit" name="simpan" value="Tambah" class="btn btn-default btn-lg">

			<a href="<?php echo base_url('admin_ekspedisi') ?>" class="btn btn-info btn-lg">Kembali</a>

		</div>

	</div>
</div>

</form>