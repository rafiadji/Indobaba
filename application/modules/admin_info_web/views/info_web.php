<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
	<?php endif; ?>

<form method="POST" action="<?php echo base_url('admin_info_web/editInfoWeb') ?>" enctype="multipart/form-data">
	<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Nama Website</label>
				<input type='text' class="form-control" name="nama" value="<?php echo $info_web->NAMA ?>"/>
			</div>
			<div class="form-group">
				<label>Deskripsi Halaman</label>
				<input type='text' class="form-control" name="des_halaman" value="<?php echo $info_web->DES_HALAMAN ?>"/>
			</div>
			<div class="form-group">
				<label>Tagline</label>
				<input type='text' class="form-control" name="tagline" value="<?php echo $info_web->TAGLINE ?>"/>
			</div>
			<div class="form-group">
				<label>Meta Deskripsi</label>
				<input type='text' class="form-control" name="meta_des" value="<?php echo $info_web->META_DES ?>"/>
			</div>
			<div class="form-group">
				<label>Meta Keyword</label>
				<input type='text' class="form-control" name="meta_key" value="<?php echo $info_web->META_KEY ?>"/>
			</div>
			<div class="form-group">
				<label>No HP</label>
				<input type='text' class="form-control" name="no_hp" value="<?php echo $info_web->NO_HP ?>"/>
			</div>
			<div class="form-group">
				<label>No Telp</label>
				<input type='text' class="form-control" name="no_telp" value="<?php echo $info_web->NO_TELP ?>"/>
			</div>
			<div class="form-group">
				<label>Facebook</label>
				<input type='text' class="form-control" name="s_fb" value="<?php echo $info_web->S_FB ?>"/>
			</div>
			<div class="form-group">
				<label>Twitter</label>
				<input type='text' class="form-control" name="s_twt" value="<?php echo $info_web->S_TWT ?>"/>
			</div>
			<div class="form-group">
				<label>Google Plus</label>
				<input type='text' class="form-control" name="s_ggl" value="<?php echo $info_web->S_GGL ?>"/>
			</div>
			<div class="form-group">
				<label>Logo</label><br />
				<img src="<?php echo base_url()?>assets/images/home/<?php echo $info_web->FT_PROFIL;?>" style="width:150px">
				<input type='file' class="form-control" name="userfile"/>
			</div>
			
			<input type="submit" class="btn btn-default btn-lg" value="Ubah informasi"/>
		</div>
	</div>
</div>
</form>