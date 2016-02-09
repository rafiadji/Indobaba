<div class="container">
	<div class="row">
	<div class="col-md-7">
			<img src="<?php echo base_url('assets/images/flyer/keu_indobaba.jpg') ?>" class="thumbnail"/>		
		</div>
		<div class="col-md-4">
			<?php if($this->session->flashdata('notif')): ?>
<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
<?php endif; ?>
			<h4>Daftar UKM baru</h4>
			<hr/>
			<div class="panel panel-default">
				<div class="panel-body">
					
					<form action="<?php echo base_url('ukm_daftar_baru/kirimUkm') ?>" method="post">
	<label>Nama Produsen</label><br/>
	<input type="text" class="form-control" name="nm_ukm" placeholder="Nama Produsen"/><br/>
	<label>No Telp</label><br/>
	<input type="text" class="form-control" name="telpon" placeholder="No Telp"/><br/>
	<label>Jenis Usaha</label><br/>
	<input type="text" class="form-control" name="usaha" placeholder="Jenis Usaha"/><br/>
	<input type="submit" class="btn btn-default" value="Kirim"/>
</form>
				</div>
			</div>
			
		</div>
		
	</div>
</div>