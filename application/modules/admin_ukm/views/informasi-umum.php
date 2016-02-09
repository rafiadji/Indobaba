<?php $i = base64_encode_fix($id); ?>

<div class="row">

	<form action="<?php echo base_url('admin_ukm/updateUkm/'.$i) ?>" method="POST" enctype="multipart/form-data">

<div class="col-md-8">

			<div class="form-group">

				<label>Nama UKM</label>

				<input type="text" class="form-control" value="<?php echo $ukm->NM_TOKO; ?>" name="nm_toko"/>

			</div>

			<div class="form-group">

				<label>Penanggung Jawab</label>

				<select name="id_penanggung_jwb" class="form-control">

					<?php foreach($penanggung_jwb as $data_penanggung): ?>

					<option <?php if($ukm->ID_PENANGGUNG_JWB==$data_penanggung->ID_PENANGGUNG_JWB){ echo "selected=''"; } ?> value="<?php echo $data_penanggung->ID_PENANGGUNG_JWB ?>"><?php echo $data_penanggung->NAMA ?></option>

					<?php endforeach; ?>

			</select>

			</div>

			<div class="form-group">

				<label>Deskripsi UKM</label>

				<textarea name="des_toko" class="form-control" id="editor1"><?php echo $ukm->DES_TOKO; ?></textarea>

			</div>



			<h4><i class="fa fa-globe"></i> Seo Optimize</h4>

			<hr />

			<div class="form-group">

				<label>Keyword Meta</label>

				<input type="text" value="<?php echo $ukm->KEY_META; ?>" name="key_meta" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Deskripsi Meta</label>

				<input type="text" name="des_meta" value="<?php echo $ukm->DES_META; ?>" class="form-control"/>

			</div>

			<h4><i class="fa fa-truck"></i> Kurir yang digunakan</h4>

			<hr />

			<table class="table table-bordered table-striped">

				<tr>

					<th>Kurir</th>

					<th>Keterangan</th>

				</tr>

				<tr>

					<td><input type="checkbox" <?php if($kurir->JNE==1) echo 'checked'; ?> name="jne" value="jne"/> JNE</td>

					<td>Jalur Nugraha Eka Kurir</td>

				</tr>

				<tr>

					<td><input type="checkbox" <?php if($kurir->TIKI==1) echo 'checked'; ?> name="tiki" value="tiki"/> TIKI</td>

					<td>Satu Titipan Kilat</td>

				</tr>

				<tr>

					<td><input type="checkbox" <?php if($kurir->POS==1) echo 'checked'; ?> name="pos" value="pos"/> POS</td>

					<td>Pos Indonesia</td>

				</tr>

			</table>


</div>

<div class="col-md-4">
	<div class="form-group">
		<div class="form-group">
			<?php if($ukm->FT_PROFIL != ""): ?>
			<img class="img-thumbnail" src="<?php echo base_url('upload/profil/'.$ukm->FT_PROFIL) ?>"/>
			<?php else: ?>
			<img src="<?php echo base_url('assets/images/user/default.png') ?>" class="img-thumbnail"/>
			<?php endif; ?>
		</div>
	</div>




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

			<h4><i class="fa fa-map-marker"></i> Lokasi UKM</h4>

			<hr />

			<div class="form-group">

				<label>Provinsi</label>

				<select id="id_provinsi" class="form-control" name="id_provinsi">

				<option>Pilih Provinsi</option>

				<?php foreach($provinsi->rajaongkir->results as $data_prov): ?>

					<option <?php if($ukm->ID_PROVINSI==$data_prov->province_id){ echo "selected=''"; } ?> value="<?php echo $data_prov->province_id; ?>"><?php echo $data_prov->province; ?></option>

				<?php endforeach; ?>

				</select>

				<p class="text-muted" id="sts"></p>

			</div>

			<div class="form-group">

				<label>Kota</label>

				<select id="id_kota" class="form-control" name="id_kota">

					<?php 

					$this->load->library('rajaongkir');

					$id_provinsi = $ukm->ID_PROVINSI;

					$data_kota = $this->rajaongkir->city($id_provinsi);

					$kota = json_decode($data_kota);

					foreach($kota->rajaongkir->results as $data_kota):

					if($data_kota->type == 'Kota'){

						$type = '( '.$data_kota->type.' )';

					}

					else{

						$type = '';

					}?>

					<option <?php if($ukm->ID_KOTA==$data_kota->city_id){ echo "selected=''"; } ?> value="<?php echo $data_kota->city_id; ?>"><?php echo $data_kota->city_name.' '.$type; ?></option>

					<?php endforeach; ?>

				</select>

			</div>

			<div class="form-group">

				<label>Kecamatan</label>

				<input type="text" value="<?php echo $ukm->KECAMATAN; ?>" name="kecamatan" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Kelurahan</label>

				<input type="text" name="kelurahan" value="<?php echo $ukm->KELURAHAN; ?>" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Alamat</label>

				<textarea name="alamat" class="form-control"><?php echo $ukm->ALAMAT; ?></textarea>

			</div>

			<h4><i class="fa fa-phone"></i> Informasi Kontak</h4>

			<hr />

			<div class="form-group">

				<label>No HP</label>

				<input type="text" name="no_hp" value="<?php echo $ukm->NO_HP; ?>" class="form-control"/>

			</div>

			<div class="form-group">

				<label>No Telepon</label>

				<input type="text" name="no_telp" value="<?php echo $ukm->NO_TELP; ?>" class="form-control"/>

			</div>

			<div class="form-group">

				<label>BBM</label>

				<input type="text" name="s_bbm" value="<?php echo $ukm->S_BBM; ?>" class="form-control"/>

			</div>

			<div class="form-group">

				<label>Whatsapp</label>

				<input type="text" name="s_whatsapp" value="<?php echo $ukm->S_WHATSAPP; ?>" class="form-control"/>

			</div>
			<div class="form-group">

				<label>Email</label>

				<input type="text" name="email" value="<?php echo $ukm->EMAIL; ?>" class="form-control"/>

			</div>


</div>
<div class="col-md-12">

			<input type="submit" value="Simpan" class="btn btn-default btn-lg"/>

			<a href="<?php echo base_url('admin_ukm') ?>" class="btn btn-info btn-lg">Kembali</a>


</div>
</form>

</div>

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