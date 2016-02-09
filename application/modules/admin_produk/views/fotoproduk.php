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
			<?=anchor("admin_produk/tambahfotoProduk/".$edit->ID_PRODUK,"Tambah Foto Produk",array('class' => 'btn btn-default btn-lg'))?>
			<?=anchor("admin_produk","Kembali",array('class' => 'btn btn-info btn-lg'))?>

		</div>
	</div>
	<div class="row">
		<?php if($tampil): ?>
	<?php foreach($tampil as $row): ?>
	<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?=site_url('assets-admin/img/produk/'.$row->FT_PRODUK)?>" style="width:100%;height: 300px" />
      <div class="caption">
      	<div class="btn-group">
      		<?=anchor("admin_produk/ubahfotoProduk/".$row->ID_GALERI_PRO,"<i class='fa fa-pencil'></i> Edit",array('class' => 'btn btn-info'))?>
			<?=anchor("admin_produk/hapusfotoProduk/".$row->ID_GALERI_PRO,"<i class='fa fa-trash'></i> Hapus",array('class' => 'btn btn-danger','onClick' => "return confirm('Hapus Foto ini ?')"))?>
      	</div>  
      </div>
    </div>
  </div>
	<?php endforeach; ?>
	<?php else: ?>
		tidak ada data
	<?php endif;?>
	</div>
</div>
	
