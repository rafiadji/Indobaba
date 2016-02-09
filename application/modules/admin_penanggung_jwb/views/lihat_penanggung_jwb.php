<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

<?php endif; ?>

<div class="col-md-12 col-xs-12">

	<div class="panel panel-default">

		<div class="panel-body table-responsive">
		<div class="form-group">

			<a href="<?php echo base_url('admin_penanggung_jwb/tambahPenanggungJwb') ?>" class="btn btn-primary btn-block btn-lg" >Tambah</a>

		</div>

			<table id="example1" class="table table-bordered table-striped">

        <thead>

        	<tr>

				<th>Nama</th>

				<th>Email</th>

				<th>Tanggal Terdaftar</th>

				<th>Aksi</th>

			</tr>

        </thead>

       <tbody>

       	<?php if($penanggung_jwb_ukm): ?>

	<?php foreach($penanggung_jwb_ukm as $data): ?>

	<tr>

		<td><?php echo $data->NAMA ?></td>

		<td><?php echo $data->EMAIL ?></td>

		<td><?php echo $data->TGL_TERDAFTAR ?></td>

		<td>

			<div class="btn-group">

				<a class="btn btn-info" href="<?php echo base_url('admin_penanggung_jwb/editPenanggungJwb/'.$data->ID_PENANGGUNG_JWB) ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Detail</a>

				<a href="<?php echo base_url('admin_penanggung_jwb/hapusPenanggungJwb/'.$data->ID_PENANGGUNG_JWB) ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>	

			</div>

		</td>

	</tr>

	<?php endforeach; ?>

	<?php endif; ?>

       </tbody>

        </table>

		</div>

	</div>

</div>

<script type="text/javascript">

    $(function() {

        $("#example1").dataTable();

    });

</script>