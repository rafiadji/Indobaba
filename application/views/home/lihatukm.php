
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="desk-produk">
	    			<h4>UKM/UMKM/IKM yang bergabung di Indobaba</h4>
	    			<br/>
	 		 		Produk-produk para UKM/UMKM/IKM yang tampil di Indobaba.com adalah harga pabrik langsung dari produsennya.    			 
    			</div>
    		</div>
    	</div>
	<div class="cari-toko">
		<div class="panel panel-default">
			<div class="panel-body">
				<!-- <div class="panel-body cari-toko" style="padding: 0; margin-bottom: 20px;"> -->
				<!--<form method="POST" class="form-inline" action="<?php echo base_url()?>home_controller/caritoko/">-->
				<table align="center">
					<tr>
						<td><input placeholder="Cari Produsen" id="namatoko" type="text" class="form-control" name="cari" value=""></td>
						<td style="padding:10px"></td>
					</tr>
					<tr>
						<td>
						<center>
								Provinsi<br/>
							<select name="provinsi" class="form-control col-md-8" id="provinsi">
									<option value="semua">Semua Provinsi</option>
									<?php foreach ($tampilprovinsi->rajaongkir->results as $data_prov):?>
										<option value="<?php echo $data_prov->province_id; ?>"><?php echo $data_prov->province; ?></option>
									<?php endforeach;?>
								</select>
						</td>
					</tr>
					<tr>
						<td>
							<div id="kotaform" style="padding:10px;display: none;"> 
								<center>
								Kota<br/>
								<div class="form-group" >
								<select name="kota" class="form-control col-md-8" id="kota">
									
									<div id="tampilkota"></div>
								</select>
								</div>
							</div>
						</td>
					</tr>
				</table>
				<!--</form>-->
				<!-- </div> -->
			</div>
		</div>
	</div>
	<div class="features_items features-puji" id="result">
		<?php if($tampill): ?>
		<div class="row">	
						<?php foreach($tampill as $tampil):?>
						<div class="col-md-2 col-xs-6">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center productinfo-puji">
											<?php if($tampil->FT_PROFIL != ''): ?>
												<div class="img-ukm">
													<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$tampil->NM_TOKO);?>">												
													<img src="<?php echo base_url();?>upload/profil/<?php echo $tampil->FT_PROFIL;?>" style="height:100px;width:100%">
													</a>
												</div>
											<?php else: ?>
												<div class="img-ukm">
													<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$tampil->NM_TOKO);?>">
														
														<img src="<?php echo base_url();?>assets/images/home/store-icon.png" style="height:100px;width:100%">
													</a>
												</div>
											<?php endif; ?>
											<h2><?php echo $tampil->NM_TOKO;?></h2>
												<a class="btn btn-default add-to-cart" href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$tampil->NM_TOKO);?>">Selengkapnya</a>
										</div>
										
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						
						
		</div>
		<div class="col-md-12"><div class="pagination"><?php echo $halaman;?></div></div>
		<?php else: ?>
		Tidak ada data...
		<?php endif;?>
	</div>
</div>
<div class="col-md-12"><div class="pagination" id="paginationn"><?php echo $halaman;?></div></div>

    	</div>
    </div>

<script type="text/javascript">
$(function() {

	 $("#namatoko").change(function(){
		 var namatoko =  $("#namatoko").val();
	  var provinsi = $("#provinsi").val();
	  var kota = $("#kota").val();
		 $.ajax({
            type: "POST",
            dataType: "html",
              url: '<?php echo base_url()?>Home_controller/caritoko/',
            data: "namatoko="+namatoko+"&provinsi="+provinsi+"&kota="+kota,
            success: function(data){
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
	  $("#provinsi").change(function(){
	   var namatoko =  $("#namatoko").val();
	  var provinsi = $("#provinsi").val();
	  var kota = "semua";
		 $.ajax({
            type: "POST",
            dataType: "html",
              url: '<?php echo base_url()?>Home_controller/caritoko/',
            data: "namatoko="+namatoko+"&provinsi="+provinsi+"&kota="+kota,
            success: function(data){
            	//alert(provinsi);
            	//alert(kota);
            	if(provinsi == "semua"){
            		 $("#kotaform").hide();
            	}
            	else{
            		$("#kotaform").show();
            		$.ajax({
			            type: "POST",
			            dataType: "html",
			            url: '<?php echo base_url()?>Home_controller/tampilkotadipencarian/',
			              data: "&provinsi="+provinsi,
			            success: function(data){
			            	//$("#tampilkota").text(data);
			            	$("#kota").html(data);
			            }
			        });

            	}
				 $("#loadingcari").fadeIn();
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
	  $("#kota").change(function(){
	  var namatoko =  $("#namatoko").val();
	  var provinsi = $("#provinsi").val();
	  var kota = $("#kota").val();
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/caritoko/',
            data: "namatoko="+namatoko+"&provinsi="+provinsi+"&kota="+kota,
			success: function(data){
            	//alert(provinsi);
            	//alert(kota);
				 $("#loadingcari").fadeIn();
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
});
</script>
