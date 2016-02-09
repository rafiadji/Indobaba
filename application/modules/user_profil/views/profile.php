<div class="col-md-9">
		<h4>Informasi Akun Anda</h4>
		<hr />
		<form method="POST" action="<?php echo base_url();?>/user_profil/update">
		<?php foreach($tampil as $row): ?>
			<div class="field-row">
                <label>Nama</label>
                <input type="text" name="nama" class="le-input" value="<?php echo $row->NAMA;?>">
            </div>
            <div class="field-row">
            	<label>Alamat</label>
            	<textarea name="alamat" class="le-input"><?php echo $row->ALAMAT;?></textarea>
            </div>
            <div class="field-row">
            	<label>Provinsi</label>
            	<select name="provinsi" class="le-input" id="prov" onchange="TRUE">
	                <option value="pilih">-Pilih Provinsi-</option>
	                <?php foreach($tampilprov as $roww): ?>
	                <option value="<?php echo $roww->ID_PROVINSI;?>" <?php if($row->ID_PROVINSI == $roww->ID_PROVINSI): echo "selected"; endif; ?>><?php echo $roww->PROVINSI;?></option>
	                <?php endforeach;?>
           		</select>
            </div>
			<div class="field-row">
            	<label>Kota</label>
            	<select name="kota" id="kota" class="le-input">
	                <option value="pilih">-Pilih Kota/kabupaten-</option>		
	            </select>
        	</div>
        	<div class="field-row">
            	<label>Kecamatan</label>
				<select name="kecamatan" id="kecam" class="le-input">
	                <option value="pilih">-Pilih Kecamatan-</option>
	            </select>
        	</div>
        	<div class="field-row">
            	<label>Keluarahan</label>
            	<input type="text" name="kelurahan" class="le-input" value="<?php echo $row->KELUHARAN;?>">	
        	</div>
        	
        	<div class="field-row">
            	<label>No. Hp</label>
				<input type="text" class="le-input" name="hp" value="<?php echo $row->NO_HP;?>">
        	</div>
        	<div class="form-group">
            	<label>Email</label>
				<input type="email" class="le-input" name="email" value="<?php echo $row->EMAIL;?>">
        	</div>
        	<div class="form-group">
        		<input type="submit" name="simpan" class="btn btn-default" value="Perbaharui Informasi">
        	</div>
        	</form>
        <script type="text/javascript">
	function myFunction() {
    //alert($("#prov").val());
	var idprov = $("#prov").val();
	  $.ajax({
            type: "GET",
            dataType: "html",
            url: '<?php echo base_url()."user_profil/getupdateKota";?>',
           // data: "idprov="+idprov&"idkota="+<?php echo $row->ID_KABUPATEN;?>,
			data: {idprov: idprov, idkota: <?php echo $row->ID_KABUPATEN;?>},
            success: function(msg){
                 if(msg == ''){
                         $("#kota").html('<option value="">--Pilih Provinsi--</option>');
                         $("#kacam").html('<option value="">--Pilih Kota--</option>');
                 }else{
                           $("#kota").html(msg);
						   var idkota = $("#kota").val();
						 
								$.ajax({
									 type: "GET",
									 dataType: "html",
									 url: '<?php echo base_url()."user_profil/getupdateKecam";?>',
									 //data: "idkota="+idkota,
									 data: {idkota: idkota, idkecam: <?php echo $row->ID_KECAMATAN;?>},
									 success: function(msg){
										  if(msg == ''){
												  $("#kota").html('<option value="">--Piliih Provinsi--</option>');
												  $("#kacam").html('<option value="">--Pilih Kota--</option>');
										  }else{
													$("#kecam").html(msg);                                                       
										  }
										  //getAjaxAlamat();                                                        
									  }
								  });
                 }
                 //getAjaxAlamat();                                                        
             }
         }); 
}
$(function() {
     $("#prov").change(function(){
        var idprov = $(this).val();
        //window.alert(idprov);
         $.ajax({
            type: "GET",
            dataType: "html",
            url: '<?php echo base_url()."user_profil/getKota";?>',
            data: "idprov="+idprov,
            success: function(msg){
                 if(msg == ''){
                         $("#kota").html('<option value="">--Pilih Provinsi--</option>');
                         $("#kacam").html('<option value="">--Pilih Kota--</option>');
                 }else{
                           $("#kota").html(msg);
						    var idkota =  $("#kota").val();
								//window.alert(idprov);
								 $.ajax({
									type: "GET",
									dataType: "html",
									url: '<?php echo base_url()."user_profil/getKecam";?>',
									data: "idkota="+idkota,
									success: function(msg){
										 if(msg == ''){
												 $("#kota").html('<option value="">--Piliih Provinsi--</option>');
												 $("#kacam").html('<option value="">--Pilih Kota--</option>');
										 }else{
												   $("#kecam").html(msg);                                                       
										 }
										 //getAjaxAlamat();                                                        
									 }
								 });
						   
                 }
                 //getAjaxAlamat();                                                        
             }
         });
		 
        
     });
      $("#kota").change(function(){
        var idkota = $(this).val();
        //window.alert(idprov);
         $.ajax({
            type: "GET",
            dataType: "html",
            url: '<?php echo base_url()."user_profil/getKecam";?>',
            data: "idkota="+idkota,
            success: function(msg){
                 if(msg == ''){
                         $("#kota").html('<option value="">--Piliih Provinsi--</option>');
                         $("#kacam").html('<option value="">--Pilih Kota--</option>');
                 }else{
                           $("#kecam").html(msg);                                                       
                 }
                 //getAjaxAlamat();                                                        
             }
         });
        
     });
});
</script>
		<?php endforeach; ?>
	
</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php echo form_open_multipart('user_profil/updatefoto');?>
				<div class="form-group">
					<?php if($row->FT_PROFIL != ""): ?>
			<img class="img-thumbnail" src="<?php echo base_url('assets/images/user/'.$row->FT_PROFIL) ?>"/>
			<?php else: ?>
			<img src="<?php echo base_url('assets/images/user/default.png') ?>" class="img-thumbnail"/>
			<?php endif; ?>
				</div>
				<div class="form-group">
					<input type="file" name="userfile" value="" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="upload" class="btn btn-default" value="Ganti Foto">
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>