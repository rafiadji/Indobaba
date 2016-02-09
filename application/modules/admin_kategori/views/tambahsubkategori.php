
<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="<?php echo base_url();?>admin_kategori/tambahSubKategoriSubmit" class="form-horizontal">
	<div class="form-group col-md-12">
		<label class="col-md-2 control-label">Nama Sub Kategori</label>
		<div class="col-md-10">
			<input type="text" name="nama_subkategori" value="" class="form-control">
		</div>
	</div>
	<div class="form-group col-md-12">
		<label class="col-md-2 control-label">Kategori</label>
		<div class="col-md-10">
			<select name="kategori" class="form-control">
				<?php foreach($kategori as $row): ?>
					<option value="<?php echo $row->ID_KATEGORI;?>"><?php echo $row->KATEGORI;?></option>
				<?php endforeach;?>   
			</select>
		</div>
	</div>
	<div class="form-group col-md-12">
		<input type="submit" name="simpan_subkategori" value="Simpan" class="btn btn-primary">
	</div>
</form>