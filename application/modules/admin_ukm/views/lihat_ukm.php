<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

<?php endif; ?>

<div class="col-xs-12 col-md-12">

	<div class="panel panel-default">

		<div class="panel-body table-responsive">
	<div class="form-group">

		<a href='<?php echo base_url('admin_ukm/tambahUkm') ?>' class="btn btn-primary btn-lg btn-block">Tambah</a>

	</div>

			<table id="example1" class="table table-bordered table-striped">

        <thead>

        	<tr>

				<th>

					Nama UKM

				</th>

				<th>

					Aksi

				</th>

			</tr>

        </thead>

       <?php if($ukm): ?>

	<?php foreach($ukm as $data_ukm): ?>
	<tr>
		<td>
			<?php echo $data_ukm->NM_TOKO ?>
		</td>
		<td>
			<div class="btn-group">
				<a href="<?php echo base_url('admin_ukm/editUkm/'.base64_encode_fix($data_ukm->ID_TOKO)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Detail</a>
				<a onclick="hapus(<?php echo $data_ukm->ID_TOKO; ?>)" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
			</div>
		</td>
	</tr>

	<?php endforeach; ?>

	<?php endif; ?>

        </table>

		</div>

	</div>

</div>

<script type="text/javascript">

    $(function() {

        $("#example1").dataTable( {

	         "bLengthChange": false,

	      } );

    });
    function hapus (id) {
    	if (confirm('Anda Yakin Hapus Data Ini?')) {
           	window.location.href="<?php echo base_url('admin_ukm/hapusUkm'); ?>"+"/"+id;
        }
    }
</script>