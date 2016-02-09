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

			<a href="<?php echo base_url('admin_ekspedisi') ?>" class="btn btn-info btn-lg">Kembali</a>

		</div>

	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<table id="example1" class="table table-bordered table-striped">

	<thead>

    	<tr>

	        <th>Provinsi</th>

	        <th>Kota</th>

	        <th>Kecamatan</th>

	        <th>Harga</th>

	        <th>Aksi</th>

    	</tr>

	</thead>

	<tbody>

    <?php if($tampil): ?>

    <tr>

        <td><?php echo $tampilprov->PROVINSI;?></td>

        <td><?php echo $tampilkota->KOKAB;?></td>

        <td><?php echo $tampilkecamatan->KECAMATAN;?></td>

        <td><?php echo formatRp($tampil->HARGA);?></td>

        <td><?php echo anchor("admin_ekspedisi/editHarga/$tampil->ID_HRG_EKS","Edit",array("class"=>"btn btn-success"));?></td>

    </tr>

    <?php endif;?>

	</tbody>

</table>

<script>

	$(function() {

        $("#example1").dataTable();

    });

</script>

		</div>

	</div>

</div>