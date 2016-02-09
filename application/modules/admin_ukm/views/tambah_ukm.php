<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>

	<?php endif; ?>



<form action="<?php echo base_url('admin_ukm/tambahUkmSubmit') ?>" method="POST" enctype="multipart/form-data" >

<div class="col-md-12">

	<div class="panel panel-default">

		<div class="panel-body">

			<input type="submit" value="Tambah UKM" class="btn btn-default btn-lg"/>

			<a href="<?php echo base_url('admin_ukm') ?>" class="btn btn-info btn-lg">Kembali</a>

		</div>

	</div>

</div>

<div class="col-md-8">

	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-info-circle"></i> Informasi UKM</h4>

			<hr />

			<div class="form-group">
				<label>Nama UKM</label>
				<input type="text" class="form-control" value="<?php echo $this->session->flashdata('nm_toko'); ?>" name="nm_toko"/>
			</div>
			<div class="form-group">

				<label>Penanggung Jawab</label>

				<select name="id_penanggung_jwb" class="form-control">

					<?php foreach($penanggung_jwb as $data_penanggung): ?>

					<option value="<?php echo $data_penanggung->ID_PENANGGUNG_JWB ?>"><?php echo $data_penanggung->NAMA ?></option>

					<?php endforeach; ?>

			</select>

			</div>

			<div class="form-group">

				<label>Deskripsi UKM</label>

				<textarea name="des_toko"  class="form-control" id="editor1"></textarea>

			</div>

		</div>

	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-globe"></i> Seo Optimize</h4>

			<hr />

			<div class="form-group">

				<label>Keyword Meta</label>

				<input type="text" name="key_meta" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Deskripsi Meta</label>

				<input type="text" name="des_meta" class="form-control"/>

			</div>

		</div>

	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-truck"></i> Kurir yang digunakan</h4>

			<hr />

			<table class="table table-bordered table-striped">

				<tr>

					<th>Kurir</th>

					<th>Keterangan</th>

				</tr>

				<tr>

					<td><input type="checkbox" checked name="jne" value="jne"/> JNE</td>

					<td>Jalur Nugraha Eka Kurir</td>

				</tr>

				<tr>

					<td><input type="checkbox" checked name="tiki" value="tiki"/> TIKI</td>

					<td>Satu Titipan Kilat</td>

				</tr>

				<tr>

					<td><input type="checkbox" checked name="pos" value="pos"/> POS</td>

					<td>Pos Indonesia</td>

				</tr>

			</table>

		</div>

	</div>

</div>

<div class="col-md-4">

	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-user"></i> Sampul Ukm</h4>

			<hr />

			<div class="form-group">
				<label>Foto Profil</label>
				<input name="profil" class="form-group" type="file" class="profil" id="profil" accept="image/*" />  
			</div>

			<div class="form-group">
				<label>Foto Sampul</label>
				<input name="userImage" class="form-group" type="file" class="inputFile" id="inputFile" accept="image/*" />  
			</div>

		</div>

	</div>
	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-user"></i> Akun UKM</h4>

			<hr />

			<div class="form-group">

				<label>Username</label>

				<input type="text" class="form-control" name="username" id="username"/>

				<p id="user-result" class="help-block"></p>

			</div>

			<div class="form-group">

				<label>Password</label>

				<input type="password" name="password" class="form-control"/>

			</div>

		</div>

	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-map-marker"></i> Lokasi UKM</h4>

			<hr />

			<div class="form-group">

				<label>Provinsi</label>

				<select id="id_provinsi" class="form-control" name="id_provinsi">

				<option>Pilih Provinsi</option>

				<?php foreach($provinsi->rajaongkir->results as $data_prov): ?>

					<option value="<?php echo $data_prov->province_id; ?>"><?php echo $data_prov->province; ?></option>

				<?php endforeach; ?>

				</select>

				<p class="text-muted" id="sts"></p>

			</div>

			<div class="form-group">

				<label>Kota</label>

				<select id="id_kota" class="form-control" name="id_kota">

					<option>Pilih provinsi terlebih dahulu</option>

				</select>

			</div>

			<div class="form-group">

				<label>Kecamatan</label>

				<input type="text" name="kecamatan" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Kelurahan</label>

				<input type="text" name="kelurahan" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Alamat</label>

				<textarea name="alamat" class="form-control"></textarea>

			</div>

		</div>

	</div>

	<div class="panel panel-default">

		<div class="panel-body">

			<h4><i class="fa fa-phone"></i> Informasi Kontak</h4>

			<hr />

			<div class="form-group">

				<label>No HP</label>

				<input type="text" name="no_hp" class="form-control"/>

			</div>

			<div class="form-group">

				<label>No Telepon</label>

				<input type="text" name="no_telp" class="form-control"/>

			</div>

			<div class="form-group">

				<label>BBM</label>

				<input type="text" name="s_bbm" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Whatsapp</label>

				<input type="text" name="s_whatsapp" class="form-control"/>

			</div>
			<div class="form-group">

				<label>Email</label>

				<input type="text" name="email" class="form-control"/>

			</div>

		</div>

	</div>

</div>

</form>

<script>

	$("#id_provinsi").change(function(){

    var id_provinsi = $("#id_provinsi").val();

    $("#sts").html('Loading kota...');

    $.ajax({

        url: "<?php echo base_url('admin_ukm/lihatKota') ?>",

		type : "POST",

        data: "id_provinsi=" + id_provinsi,

        cache: false,

        success: function(msg){

        	 $("#sts").html('');

            $("#id_kota").html(msg);

        }

    });

  });

  
  $("#username").keyup(function (e) {

		$(this).val($(this).val().replace(/\s/g, ''));

		var username = $(this).val();

		if(username.length < 6){$("#user-result").html('');return;}

		if(username.length >= 6){

			$("#user-result").html('Tunggu sebentar...');

			$.post('<?php echo base_url() ?>admin_ukm/cekUsername', {'username':username}, function(data) {

			  	$("#user-result").html(data);

			});

		}

	});

	

	$(function(){

    	CKEDITOR.replace('editor1');

	});

</script>