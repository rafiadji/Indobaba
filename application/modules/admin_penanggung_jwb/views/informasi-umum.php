<form action='<?php echo base_url('admin_penanggung_jwb/editPenanggungJwbSubmit') ?>' method='POST' enctype="multipart/form-data">
	<input type="hidden" name="id_penanggung_jwb" value="<?php echo $detail->ID_PENANGGUNG_JWB ?>"/>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<input type="submit" class="btn btn-default btn-lg" value="Ubah Informasi"/>
				<a href="<?php echo base_url('admin_penanggung_jwb') ?>" class="btn btn-info btn-lg">Kembali</a>
			</div>
		</div>
		<div class="col-md-3">
			<?php if($detail->FT_PROFIL != ""):?>
			<img style="height:250px;width:100%" class="img-responsive img-circle" src="<?php echo base_url('assets-admin/img/penanggung_jwb/'.$detail->FT_PROFIL) ?>"/>
			<?php else: ?>
			<img style="height:250px;width:100%" class="img-responsive img-circle" src="<?php echo base_url('assets/images/user/default.png') ?>"/>
			<?php endif; ?>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama" value="<?php echo $detail->NAMA ?>"/>
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat"><?php echo $detail->ALAMAT ?></textarea>
			</div>
			<div class="form-group">
				<label>Telp</label>
				<input type="text" class="form-control" name="telp" value="<?php echo $detail->TELP ?>"/>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email" value="<?php echo $detail->EMAIL ?>"/>
			</div>
			<div class="form-group">
				<label>Foto Profil</label>
				<input type="file" class="form-control" name="foto_profil"/>
				<p>Kosongi jika tidak ingin mengganti foto</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Provinsi</label>
				<select id="id_provinsi" class="form-control" name="id_provinsi">
					<option>Pilih Provinsi</option>
					<?php foreach($provinsi as $data_provinsi):?>
					<option <?php if($data_provinsi->ID_PROVINSI == $detail->ID_PROVINSI) echo 'selected'; ?> value="<?php echo $data_provinsi->ID_PROVINSI ?>"><?php echo $data_provinsi->PROVINSI ?>
					<?php endforeach; ?>
				</select>
				<p id="sts"></p>
			</div>
			<div class="form-group">
				<label>Kota / Kabupaten</label>
				<select id="id_kota" class="form-control" name="id_kota">
					<?php foreach($kota as $data_kota):?>
					<option <?php if($data_kota->ID_KOTA == $detail->ID_KOTA) echo 'selected'; ?> value="<?php echo $data_kota->ID_KOTA ?>"><?php echo $data_kota->KOKAB ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Kecamatan</label>
				<select id="id_kecamatan" class="form-control" name="id_kecamatan">
					<?php foreach($kecamatan as $data_kecamatan):?>
					<option <?php if($data_kecamatan->ID_KECAMATAN == $detail->ID_KECAMATAN) echo 'selected'; ?> value="<?php echo $data_kecamatan->ID_KECAMATAN ?>"><?php echo $data_kecamatan->KECAMATAN ?>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Kelurahan</label>
				<input type="text" class="form-control" name="kelurahan" value="<?php echo $detail->KELURAHAN ?>"/>
			</div>
		</div>
	</div>
</form>



<script>
	$("#id_provinsi").change(function(){
    var id_provinsi = $("#id_provinsi").val();
    $("#sts").html('Tunggu sebentar...');
    $.ajax({
        url: "<?php echo base_url('admin_penanggung_jwb/lihatKota') ?>",
		type : "POST",
        data: "id_provinsi=" + id_provinsi,
        cache: false,
        success: function(msg){
        	$("#sts").html('');
            $("#id_kota").html(msg);
            $("#id_kecamatan").html('<option>Pilih Kecamatan</option>');
        }
    });
  });
  $("#id_kota").change(function(){
    var id_kota = $("#id_kota").val();
    $("#sts").html('Tunggu sebentar...');
    $.ajax({
        url: "<?php echo base_url('admin_penanggung_jwb/lihatKecamatan') ?>",
		type : "POST",
        data: "id_kota=" + id_kota,
        cache: false,
        success: function(msg){
        	 $("#sts").html('');
            $("#id_kecamatan").html(msg);
        }
    });
  });
</script>