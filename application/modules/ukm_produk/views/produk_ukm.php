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
		<?= anchor("ukm_produk/tambahProduk/","<i class='fa fa-plus'></i> Tambah Produk",array('class' => 'btn btn-primary btn-lg btn-block'))?>
	</div>
</div>
<div class="col-md-9 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
				<th>Nama Produk</th>
				<th>Tanggal Posting</th>
				<th>Aksi</th>
			</tr>
        </thead>
       <tbody>
       	<?php if($tampil): ?>
	<?php foreach($tampil as $row): ?>
		<tr>
			<td><?=$row->NM_PRODUK;?></td>
			<td><?php echo ubahFormatTgl($row->TGL_POS,'d-m-Y').' - '.$row->WKT_POS;?></td>
			<td>
				<div class="btn-group">	
				<?php echo anchor("ukm_produk/fotoProduk/".$row->ID_PRODUK,"<i class='fa fa-image'></i> Foto",array('class' => 'btn btn-primary'))?>
				<?php echo anchor("ukm_produk/ubahProduk/".$row->ID_PRODUK,"<i class='fa fa-pencil'></i> Edit",array('class' => 'btn btn-info'))?>
				<?php echo anchor("ukm_produk/hapusProduk/".$row->ID_PRODUK,"<i class='fa fa-trash'></i> Hapus",array('class' => 'btn btn-danger','onClick' => "return confirm('Hapus Produk $row->NM_PRODUK ?')"))?>
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