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

			<table id="example1" class="table table-bordered table-striped">

        <thead>

        	<tr>

				<th>Nama</th>

				<th>Email</th>

				<th>Validasi</th>

				<th>Aksi</th>

			</tr>

        </thead>

       <tbody>

       	<?php if($tampil): ?>

		<?php foreach($tampil as $row):?>

		<?php

			if($row->STATUS_VALID == 1){

				$valid = 'Sudah';

				$status = 'success';

			}

			else{

				$valid = 'Belum';

				$status = 'info';

			}

		?>

		<tr>

			<td><?php echo $row->NAMA;?></td>

			<td><?php echo $row->EMAIL;?></td>

			<td><span class="label label-<?php echo $status ?>"><?php echo $valid;?></span></td>

			<td><?php echo anchor("admin_customers/detailCustomers/$row->ID_AKUN","Detail",array("class"=>"btn btn-info"));?></td>

		</tr>

		<?php endforeach;?>

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