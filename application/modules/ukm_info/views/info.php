

<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<form style="display:inline-block;" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>ukm_info/gantiprofile">
        <div class="form-group"> 
				<label>Foto Profile</label><br>
				<div class="form-group">
				<?php if($tampil->FT_PROFIL != ""):?>
				      <img class="img-thumbnail" src="<?php echo base_url();?>upload/profil/<?php echo $tampil->FT_PROFIL;?>" style="width:200px;">
				<?php else:?>
					 <img class="img-thumbnail" src="<?php echo base_url();?>assets/images/home/store-icon.png" style="width:200px;">
				<?php endif;?>	
				</div>
		<input type="file" class="form-control" name="userfile"/>
		</div>
          	<div class="form-group"> 
                <input type="submit" name="ftprofile" value="Ganti Foto Profil" class="btn btn-default">
		  </div>
    </form>
		</div>
	</div>
	<!--<div class="panel panel-default">
		<div class="panel-body">
			 <form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>ukm_info/gantisampul">
		<div class="form-group"> 
				<label>Foto Sampul</label><br>
				<div class="form-group">
                	<img class="img-thumbnail" src="<?php echo base_url();?>upload/sampul/<?php echo $tampil->FT_SAMPUL;?>" style="width:150px;">
                </div>
                <input type="file" class="form-control" name="userfile">

	   </div>

	   <div class="form-group"> 
			<input type="submit" name="ftsampul" value="Ganti Foto Sampul" class="btn btn-default">
	   </div>

    </form>
		</div>
	</div>-->
</div>
<div class="col-md-8">
<div class="panel panel-default">
	<div class="panel-body">
		<form method="POST">
    <div class="form-group"> 
            <label>Nama Toko </label>
            <input type="text" name="nama" value="<?php echo $tampil->NM_TOKO;?>"  class="form-control" >
	</div>
	<div class="form-group"> 
            <label>Penanggung Jawab : </label>
             <label><?php echo $pj->NAMA;?></label>
	</div>
	<div class="form-group"> 
            <label>Deskripsi</label>
            <textarea name="des" id="editor1"  class="form-control" ><?php echo $tampil->DES_TOKO;?></textarea>
	</div>
	<div class="form-group"> 
			<label>Provinsi</label>
				<select id="id_provinsi" class="form-control" name="id_provinsi">
				<option>Pilih Provinsi</option>
				<?php foreach($provinsi->rajaongkir->results as $data_prov): ?>
					<option value="<?php echo $data_prov->province_id; ?>" <?php if($tampil->ID_PROVINSI ==  $data_prov->province_id): echo "selected"; endif;?>><?php echo $data_prov->province; ?></option>
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
            <input type="post" name="kecamatan" value="<?php echo $tampil->KECAMATAN;?>"  class="form-control">
	</div>
	<div class="form-group"> 
            <label>Kelurahan</label>
            <input type="post" name="kelurahan" value="<?php echo $tampil->KELURAHAN;?>"  class="form-control">
	</div>
	<div class="form-group"> 
            <label>Alamat</label>
            <textarea name="alamat"  class="form-control"><?php echo $tampil->ALAMAT;?></textarea>
	</div>
	<div class="form-group"> 
	      <label>No HP</label>
          <input type="text" name="nohp" value="<?php echo $tampil->NO_HP;?>"  class="form-control">
	</div>
	<div class="form-group"> 
       <label>No Telp</label>
       <input type="text" name="notelp" value="<?php echo $tampil->NO_TELP;?>"  class="form-control">
	</div>
	<div class="form-group"> 
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $tampil->EMAIL;?>"  class="form-control">
	</div>
	<div class="form-group"> 
       <label>BBM ID</label>
       <input type="text" name="bbm" value="<?php echo $tampil->S_BBM;?>"  class="form-control">
	</div>
	<div class="form-group"> 
       <label>WHATSAPP</label>
       <input type="text" name="wa" value="<?php echo $tampil->S_WHATSAPP;?>" class="form-control">
	</div>
	<div class="form-group"> 
            <label>Keyword Meta</label>
            <textarea name="key"  class="form-control"><?php echo $tampil->KEY_META;?></textarea>
	</div>
	<div class="form-group"> 
            <label>Desc Meta</label>
            <textarea name="keydes"  class="form-control"><?php echo $tampil->DES_META;?></textarea>
	</div>
	<div class="form-group"> 
       <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
	</div>
</form>
	</div>
</div>
</div>
<script>
        $( document ).ready(function() {
            myFunction();
        });

function myFunction() {

            var id_provinsi = $("#id_provinsi").val();

            $("#sts").html('Loading kota...');

             $.ajax({

                 url: "<?php echo base_url('ukm_info/lihatKotaku') ?>",



                type : "POST",



                data: "id_provinsi=" + id_provinsi + "&id_kota_db=" + <?php echo $tampil->ID_KOTA;?>,



                cache: false,



                success: function(msg){



                    $("#sts").html('');



                    $("#id_kota").html(msg);



                }

             });

}

        



	$("#id_provinsi").change(function(){



    var id_provinsi = $("#id_provinsi").val();



    $("#sts").html('Loading kota...');



    $.ajax({



        url: "<?php echo base_url('ukm_info/lihatKota') ?>",



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

