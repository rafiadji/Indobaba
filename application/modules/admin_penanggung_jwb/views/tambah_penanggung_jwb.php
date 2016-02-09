<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
	

<form action='<?php echo base_url('admin_penanggung_jwb/tambahPenanggungJwbSubmit') ?>' method='POST' enctype="multipart/form-data">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<input type="submit" value="Tambah" class="btn btn-default btn-lg"/>
				<a href="<?php echo base_url('admin_penanggung_jwb') ?>" class="btn btn-info btn-lg">Kembali</a>
			</div>
		</div>
	</div>
	<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-users"></i> Informasi Penanggung Jawab</h4>
			<hr />
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="nama"/>
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<textarea class="form-control" name="alamat"></textarea>
			</div>
			<div class="form-group">
				<label>Telp</label>
				<input type="text" class="form-control" name="telp"/>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email"/>
			</div>
			<div class="form-group">
				<label>BBM</label>
				<input type="text" class="form-control" name="s_bbm"/>
			</div>
			<div class="form-group">
				<label>Foto Profil</label>
				<input type="file" class="form-control" name="foto_profil"/>
				<p>Kosongi jika foto tidak diisi</p>
			</div>
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-map-marker"></i> Lokasi</h4>
			<hr />
			<div class="form-group">
				<label>Provinsi</label>
				<select id="id_provinsi" class="form-control" name="id_provinsi">
					<option>Pilih Provinsi</option>
					<?php foreach($provinsi as $data_provinsi):?>
					<option value="<?php echo $data_provinsi->ID_PROVINSI ?>"><?php echo $data_provinsi->PROVINSI ?>
					<?php endforeach; ?>
				</select>
				<p id="sts" class="text-muted"></p>
			</div>
			<div class="form-group">
				<label>Kota / Kabupaten</label>
				<select class="form-control" id="id_kota" name="id_kota">
					<option>Pilih Kota / Kabupaten</option>
				</select>
			</div>
			<div class="form-group">
				<label>Kecamatan</label>
				<select class="form-control" id="id_kecamatan" name="id_kecamatan">
					<option>Pilih Kecamatan</option>
				</select>
			</div>
			<div class="form-group">
				<label>Kelurahan</label>
				<input type="text" class="form-control" name="kelurahan"/>
			</div>
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