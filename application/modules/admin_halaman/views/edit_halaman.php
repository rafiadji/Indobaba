<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
	<?php endif; ?>
	<?php $i = base64_encode_fix($id); ?>
<form action="<?php echo base_url('admin_halaman/updateHalaman/'.$i); ?>" method="POST">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Edit Halaman" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_halaman'); ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Nama Menu</label>
				<input type="text" class="form-control" value="<?php echo $tampil->NAMA_MENU; ?>" name="nama_menu"/>
			</div>
			<div class="form-group">
				<label>Judul</label>
				<input type="text" class="form-control" value="<?php echo $tampil->JUDUL; ?>" name="judul"/>
			</div>
			<div class="form-group">
				<label>Isi</label>
				<textarea name="isi" class="form-control"><?php echo $tampil->ISI; ?></textarea>
			</div>
			<div class="form-group">
				<label>Link</label>
				<input type="text" class="form-control" value="<?php echo $tampil->LINK; ?>"  name="link"/>
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="status">
					<option <?php if($tampil->STATUS==1) echo "selected=''"; ?> value="1">Publikasikan</option>
					<option <?php if($tampil->STATUS==0) echo "selected=''"; ?> value="0">Draft</option>
				</select>
			</div>
			<div class="form-group">
				<label>Des Meta</label>
				<input type="text" class="form-control" value="<?php echo $tampil->DES_META; ?>" name="des"/>
			</div>
			<div class="form-group">
				<label>Key Meta</label>
				<input type="text" class="form-control" value="<?php echo $tampil->KEY_META; ?>" name="key"/>
			</div>
		</div>
	</div>
</div>
</form>