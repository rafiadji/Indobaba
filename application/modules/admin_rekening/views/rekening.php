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
<div class="form-group">
	<?= anchor("admin_rekening/tambahRekening/","Tambah",array('class' => 'btn btn-primary btn-lg btn-block'))?>
</div>
<div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-user"></i> Admin</a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-user"></i> UKM</a></li>
                                    <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-user"></i> Penanggung Jawab</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                    	<table id="example1" class="table table-bordered table-striped table-responsive">

        <thead>

        	<tr>
				<th>Nama Pemilik</th>
				<th>Atas Nama</th>
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
			<td><?php echo $row->ATAS_NAMA;?></td>

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
                                    <div class="tab-pane" id="tab_2">
                                    	<table id="ukm" class="table table-bordered table-striped table-responsive">

        <thead>

        	<tr>
				<th>Nama Pemilik</th>
				<th>Atas Nama</th>
				<th>No Rekening</th>
				<th>Bank</th>
				<th>Aksi</th>
			</tr>

        </thead>

       <tbody>

       	<?php if($tampil_ukm): ?>

	<?php foreach($tampil_ukm as $row): ?>

		<tr>

			<td><?php echo $row->PEMILIK;?></td>
			<td><?php echo $row->ATAS_NAMA;?></td>

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
                                    <div class="tab-pane" id="tab_3">
                                    	<table id="pj" class="table table-bordered table-striped table-responsive">

        <thead>

        	<tr>
				<th>Nama Pemilik</th>
				<th>Atas Nama</th>
				<th>No Rekening</th>
				<th>Bank</th>
				<th>Aksi</th>
			</tr>

        </thead>

       <tbody>

       	<?php if($tampil_pj): ?>

	<?php foreach($tampil_pj as $row): ?>

		<tr>

			<td><?php echo $row->PEMILIK;?></td>
			<td><?php echo $row->ATAS_NAMA;?></td>

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
	

</div>

<script type="text/javascript">

    $(function() {

        $("#example1").dataTable();

    });
    $(function() {

        $("#ukm").dataTable();

    });
    $(function() {

        $("#pj").dataTable();

    });

</script>