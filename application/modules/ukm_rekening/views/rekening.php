<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

<?php endif; ?>

<div class="col-md-3 col-xs-12">

	<div class="form-group">

		<?= anchor("admin_rekening/tambahRekening/","Tambah",array('class' => 'btn btn-primary btn-lg btn-block'))?>

	</div>

</div>

<div class="col-md-9 col-xs-12">

	<div class="panel panel-default">

		<div class="panel-body table-responsive">

			<table id="example1" class="table table-bordered table-striped">

        <thead>

        	<tr>

				<th>Nama Pemilik</th>

				<th>No Rekening</th>

				<th>Bank</th>

				<th>Aksi</th>

			</tr>

        </thead>

       <tbody>

       	<?php if($tampil): ?>

	<?php foreach($tampil as $row): ?>

		<tr>

			<td><?php echo $row->PEMILIK;?></td>

			<td><?php echo $row->NO_REKENING;?></td>

			<td><?php echo $row->BANK;?></td>

			<td>

				<div class="btn-group">	

				<?php echo anchor("admin_rekening/ubahRekening/".$row->ID_REKENING,"<i class='fa fa-pencil'></i> Edit",array('class' => 'btn btn-info'))?>

				<?php echo anchor("admin_rekening/hapusRekening/".$row->ID_REKENING,"<i class='fa fa-trash'></i> Hapus",array('class' => 'btn btn-danger','onClick' => "return confirm('Hapus Produk $row->PEMILIK ?')"))?>

					

				</div>

			</td>

				

		</tr>

	<?php endforeach; ?>

	<?php endif;?>

       </tbody>

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

</script>