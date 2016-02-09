<div class="row">
	<div class="col-md-12">
		<div class="form-group">		
			<?php echo anchor("admin_customers/","Kembali",array("class" => "btn btn-info btn-lg")); ?>
		</div>
	</div>
	<div class="col-md-3">
		<?php if($tampil->FT_PROFIL != ''): ?>
		<img class="img-responsive img-circle" src="<?php echo base_url();?>assets/images/user/<?php echo $this->customersmodel->cekFoto($tampil->ID_AKUN);?>" style="width: 100%;height:240px;"/>
		<?php else: ?>
		<img class="img-responsive img-circle" src="<?php echo base_url();?>assets/images/user/default.png" style="width: 100%;height:240px;"/>
		<?php endif; ?>
	</div>
	<div class="col-md-9">
		<?php if($tampil->STATUS_VALID == 0): ?>
			<div class="alert alert-info">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Akun ini belum diverifikasi oleh <?php echo $tampil->NAMA ?>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Nama</label>
					<br/><?php echo $tampil->NAMA;?>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<br/><?php echo $tampil->ALAMAT;?>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<br/><?php echo $tampil->NO_HP;?>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<br/><?php echo $tampil->EMAIL;?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Provinsi</label>
					<br/><?php echo $this->customersmodel->cekProvinsi($tampil->ID_PROVINSI);?>
				</div>
				<div class="form-group">
					<label>Kota / Kabupaten</label>
					<br/><?php echo $this->customersmodel->cekKota($tampil->ID_KABUPATEN);?>
				</div>
				<div class="form-group">
					<label>Kecamatan</label>
					<br/><?php echo $this->customersmodel->cekKecam($tampil->ID_KECAMATAN);?>
				</div>
				<div class="form-group">
					<label>Kelurahan</label>
					<br/><?php echo $tampil->KELUHARAN;?>
				</div>
			</div>
		</div>
	</div>
</div>