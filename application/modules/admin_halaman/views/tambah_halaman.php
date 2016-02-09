<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
	<?php endif; ?>
<form action="<?php echo base_url('admin_halaman/tambahHalaman'); ?>" method="POST">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Tambah Halaman" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_halaman'); ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>Nama Menu</label>
				<input type="text" class="form-control"  name="nama_menu"/>
			</div>
			<div class="form-group">
				<label>Judul</label>
				<input type="text" class="form-control"  name="judul"/>
			</div>
			<div class="form-group">
				<label>Isi</label>
				<textarea name="isi" id="editor1" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label>Link</label>
				<input type="text" class="form-control"  name="link"/>
			</div>
			<div class="form-group">
				<label>Status</label>
				<select class="form-control" name="status">
					<option value="1">Publikasikan</option>
					<option value="0">Draft</option>
				</select>
			</div>
			<div class="form-group">
				<label>Des Meta</label>
				<input type="text" class="form-control"  name="des"/>
			</div>
			<div class="form-group">
				<label>Key Meta</label>
				<input type="text" class="form-control"  name="key"/>
			</div>
		</div>
	</div>
</div>
</form>
<script>
	$(function(){
    	CKEDITOR.replace('editor1');
	});
</script>