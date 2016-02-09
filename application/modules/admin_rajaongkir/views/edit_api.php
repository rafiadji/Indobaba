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
<form action="<?php echo base_url('admin_rajaongkir/updateRajaongkir/'.$i); ?>" method="POST">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Edit RajaOngkir" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_rajaongkir'); ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-info-circle"></i> Edit API RajaOngkir</h4>
			<hr />
			<div class="form-group">
				<label>Nama Akun</label>
				<input type="text" class="form-control" value="<?php echo $tampil->NAMA; ?>" name="nama"/>
			</div>
			<div class="form-group">
				<label>Api Key</label>
				<input type="text" class="form-control" value="<?php echo $tampil->API_KEY; ?>" name="api"/>
			</div>
			<div class="form-group">
				<label>Tipe Akun</label>
				<select class="form-control" name="tipe">
					<option <?php if($tampil->TIPE_AKUN=="STARTER") echo "selected=''"; ?> value="STARTER">STARTER</option>
					<option <?php if($tampil->TIPE_AKUN=="BASIC") echo "selected=''"; ?> value="BASIC">BASIC</option>
					<option <?php if($tampil->TIPE_AKUN=="PRO") echo "selected=''"; ?> value="PRO">PRO</option>
				</select>
			</div>
		</div>

	</div>
</div>
</form>