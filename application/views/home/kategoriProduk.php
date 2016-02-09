<?php  $linkg = site_url('assets/loading.gif'); ?>
<style type="text/css">
	 	.loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            opacity: 0.5;
            filter: alpha(opacity=100);
            background: url(<?php echo $link; ?>) 50% 50% no-repeat rgb(249,249,249);
        }
</style>
<div class="loader"></div>
<div id="products-tab" class="wow fadeInUp">
    <div class="container">
    <div class="row">
    <div class="col-md-12">
    	<h4>Kategori <?=$judul?></h4>
    	<hr/>
    	<!--<div class="panel panel-default">
		<div class="panel-body">
			<div  class="form-inline">
			
				<div class="form-group">
					<input style="width: 300px;" type="text" placeholder="Cari produk dari kategori <?=$judul?>" id="produk" name="cariprodukkategori" class="form-control col-md-8">
				</div>
				<div class="form-group">
					<input style="width: 100px;" type="text" id="min" placeholder="Harga Min" <?=$judul?>" name="min" class="form-control col-md-8">
				</div>-
				<div class="form-group">
					<input style="width: 100px;" type="text" id="max" placeholder="Harga Max" <?=$judul?>" name="max" class="form-control col-md-8">
				</div>
				<div class="form-group">
							<select name="urut" class="form-control col-md-8" id="urut">
								<option value="semua">Semua Produk</option>
								<option value="baru">Terbaru</option>
								<option value="murah">Termurah</option>
								<option value="mahal">Termahal</option>
								<option value="laris">Terlaris</option>
							</select>
						</div>
				<div class="form-group">
						<img src="<?php echo base_url();?>assets/ajax-loader.gif" id="loadingcari" style="display:none;">
				</div>
			</div>
			
		</div>
	</div>-->
	<div class="row">
		<div class="col-md-12 panel-puji">
			<div class="panel panel-default" style="background:#e67e22;color:white">
				<div class="panel-body">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Pencarian</label>
									<input type="text" placeholder="Ketik kata kunci, lalu enter " id="produk" name="cariprodukkategori" class="form-control">
								</div>
							</div>
							
							<div class="col-md-4">
								<label>Provinsi</label>
								<div class="form-group" >
								<select name="provinsi" class="form-control" id="provinsi">
									<option value="semua">Semua Provinsi</option>
									<?php foreach ($tampilprovinsi->rajaongkir->results as $data_prov):?>
										<option value="<?php echo $data_prov->province_id; ?>"><?php echo $data_prov->province; ?></option>
									<?php endforeach;?>
								</select>
								</div>
							</div>
							<div class="col-md-4" id="kotaform"> 
								<label>Kota</label>
								<div class="form-group" >
								<select name="kota" class="form-control" id="kota">
									<option value="semua">Semua Kota</option>
									<div id="tampilkota"></div>
								</select>
								</div>
							</div>
							<div class="col-md-12" style="text-align: center;">
								<img src="<?php echo $linkg;?>" id="loadingcari" style="display:none;">
							</div>
						</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 panel-puji">
			<div class="panel panel-default" style="background:#ecf0f1;color:black">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
								<div class="form-group">
								<label>Cari berdasarkan harga</label>
								<div class="row">
									<div class="col-md-5">
										<input type="text" id="min" placeholder="Harga Min" name="min" class="form-control"/>
									</div>
									<div class="col-md-2">
										<label style="margin-top:5px">s/d</label>
									</div>
									<div class="col-md-5">
										<input type="text" id="max" placeholder="Harga Max" name="max" class="form-control">
									</div>
								</div>
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
									<label>Sortir berdasarkan</label>
									<select name="urut" class="form-control" id="urut">
										<option value="semua">Semua Produk</option>
										<option value="baru">Terbaru</option>
										<option value="murah">Termurah</option>
										<option value="mahal">Termahal</option>
										<option value="laris">Terlaris</option>
									</select>
								</div>
							</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
    </div>
	</div>
	<div id="result">
            <?php 
            	if($tampil):
            	$c = 0;
            ?>
	        <?php 
	        	foreach($tampil as $row):
	        	$c++;
	        ?>
	        <?php if(($c % 4) == 1) echo '<div class="product-grid-holder">'; ?>
	        <?php $link = setPermalink($row->ID_PRODUK,$row->NM_PRODUK);?>
            <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                <div class="product-item">
                    <div class="image">
                        <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>">
                        	<?php foreach($this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE,1) as $row_gambar):?>
                                <img style="width:246px;height:186px;" src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/rs.php?ok=none.jpg";endif;?>" alt="" />
                            <?php endforeach; ?>
                    	</a>
                    </div>
                    <div class="body">
                        <div class="title">
                            <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>"><?=$row->NM_PRODUK?></a>
                        </div>
                    </div>
                    <div class="prices">
                        <div class="price-current text-center"><?php $h_grosir = explode("|",$row->HARGA);$hh_grosir = explode("-",$h_grosir[0]);if($row->STS_GROSIR == 0):echo formatRp($row->HARGA);else: echo formatRp($hh_grosir[2]); endif;?></div>
                    </div>
                    <div class="hover-area">
                        <div class="add-cart-button">
                            <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>" class="le-button">Selengkapnya</a>
                        </div>
                        <div class="wish-compare">
                            <?php foreach($this->producthomemodel->tampilData("mp_toko","NM_TOKO",array("ID_TOKO" => $row->ID_TOKO)) as $row_namaukm): $nama_toko = str_replace(" ","-",$row_namaukm->NM_TOKO);echo anchor("Home_controller/ukm/$nama_toko",$row_namaukm->NM_TOKO,'class="btn-add-to-wishlist"'); endforeach;?>
                            <?php foreach($this->producthomemodel->tampilData("mp_kategori","*",array("ID_KATEGORI" => $row->ID_KATEGORI)) as $row_kategori):  endforeach; foreach($this->producthomemodel->tampildata("mp_sub_kategori","*",array("ID_SUB_KATEGORI" => $row->ID_SUB_KATEGORI)) as $row_subkategori): $link = setPermalink($row_subkategori->ID_SUB_KATEGORI,$row_subkategori->SUB_KATEGORI);echo anchor("home_controller/kategori/$link",$row_subkategori->SUB_KATEGORI,'class="btn-add-to-compare"'); endforeach;?>
                        </div>
                    </div>
                </div>
            </div>


			
			<?php
				if(($c % 4) == 0) echo '</div>';
				endforeach;
			?>
		</div>
			<?php endif; ?>

				</div>
        <div class="row">
    	<div class="col-md-12">
            <div class="pagination" id="paginationn"><?php echo $halaman;?></div>    
    </div>
    </div>
    </div>
	
	
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Beli</h4>
      </div>
      <div class="modal-body">
      		<div class="row">
      			<form action="#" method="POST">
      				<div class="">
	      				<div class="col-xs-12 col-md-12">
		      				<input type="hidden" class="form-control"  id="id_produktext"/>
		      				<table class="table table-bordered">
		      					<tr>
		      						<th>Nama Barang</th>
		      						<th>Jumlah Barang</th>
		      						<th>Harga</th>
		      					</tr>
		      					<tr>
		      						<td>
		      							<p id="nama_barang"></p>
		      						</td>
		      						<td>
		      							<input maxlength="4" type="text" min="1" class="form-control" onblur="do_hitung()" id="qty" value="1"  />
		      						</td>
		      						<td>
		      							<span id="harga"></span>
										<input type="hidden" class="form-control"  id="hargatext" />
		      						</td>
		      					</tr>
		      				</table>
	      				</div>
      				</div>
					<div class="col-md-7">
						
					</div>
      			</form>
      		</div>
      		<form action="#" method="POST">
			<div class="panel panel-default">
				<div class="panel-body">
				<?php 
				$akun = $this->session->userdata("id_akun_user");
				$cekalamat = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->num_rows(); ?>
				<?php if($cekalamat>0)
				{
					$a="";
					$b="style='display:none;'";
				} 
				else
				{
					$b="";
					$a="style='display:none;'";
				}

					?>
				<div <?php echo $a; ?> id="alamatdropdown">
				<div class="form-group">
					<a href="#" onclick="tambahalamat()" class="btn btn-default"><i class="fa fa-plus"></i> Alamat Baru</a>	
				</div>
					<div class="form-group">
						<label>Alamat Pengiriman</label>
						<select name="alamat" onchange="alamat_stts()" id="id_alamat" class="select form-control">
						<?php echo "<option>---Pilih Alamat---</option>"; ?>
					    <?php foreach ($getalamat as $isi) { ?>
					        <option <?php if($isi->STS==1) echo "selected=''"; ?> value="<?php echo $isi->ID_ALAMAT; ?>"><?php echo $isi->SIMPAN_SEBAGAI." - ".$isi->ALAMAT; ?></option>
					    <?php } ?>
					    </select>
					</div>
					<div class="info-alamat"></div>
				</div>

				<div <?php echo $b; ?> id="tambahkanalamat">
					<div class="form-group">
						<a href="#" onclick="kembali()" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="form-group">
						<label>Simpan Sebagai</label>
						<input type="text" id="simpansebagai" class="form-control" placeholder="Simpan Sebagai Alamat Rumah / Pacar"/>
					</div>
					<div class="form-group">
						<label>Alamat Lengkap</label>
						<input type="text" id="alamat" class="form-control" placeholder="Masukan Alamat Lengkap"/>
					</div>
					<div class="form-group">
						<label>Nama Penerima</label>
						<input type="text" id="nama_penerima" class="form-control" placeholder="Masukan Nama Penerima"/>
					</div>
					<div class="form-group">
						<label>No HP Penerima</label>
						<input type="text" id="no_hp_penerima" class="form-control" placeholder="Masukan No HP Penerima"/>
					</div>
					<div class="form-group">
						<label>Kode POS</label>
						<input type="text" id="kode_pos" class="form-control" placeholder="Masukan Kode POS"/>
					</div>
					<div class="form-group">
						<label>Piliih Provinsi</label>
						<select id="id_provinsi" class="form-control" name="id_provinsi">
						    <option>Pilih Provinsi</option>
						    <?php foreach($tampilprovinsi->rajaongkir->results as $data_prov): ?>
					        <option value="<?php echo $data_prov->province_id; ?>"><?php echo $data_prov->province; ?></option>
					    	<?php endforeach; ?>
					    </select>
	    				<p class="text-muted" id="sts"></p>
    				</div>
    				<div class="form-group">
						<label>Pilih Kota</label>
					    <select id="id_kota" class="form-control" name="id_kota">
					        <option>Pilih provinsi terlebih dahulu</option>
					    </select>
					</div>
					<div class="form-group">
						<label></label>
					    <a href="#" onclick="do_alamat()" class="btn btn-success">Tambahkan</a>
					</div>
				</div>
					<div class="form-group">
						<label>Kurir Pengirimaan</label>
						<select id="kurir" onchange="do_hitung_uang()" class="form-control" name="kurir">
						<option value="0">---Pilih Kurir---</option>
						    <?php 
						    foreach($tampill as $row):
						    $tokone = $row->ID_TOKO;
						    $kurir = $this->db->query("SELECT * FROM mp_kurir WHERE ID_TOKO='$tokone'")->row();
						    
						    if($kurir->JNE==1)
						    {
						    ?>
					        <option value="jne">JNE</option>
					        <?php 
					        }
					        if($kurir->TIKI==1)
						    {
						    ?>
					        <option value="tiki">TIKI</option>
					        <?php 
					        }
					        if($kurir->POS==1)
						    {
						    ?>
					        <option value="pos">POS</option>
					        <?php 
					        }
					        endforeach;
					        ?>
					    	
					    </select>
					    <?php echo $this->db->last_query();?>
					</div>
					<div class="form-group">
						<label>Ongkir</label><br/>
					    <span id="ongkir">-</span>
					</div>
					<div class="form-group">
					    <span id="a"></span>
					    <input type="hidden" id="hargapengiriman">
					</div>
					<div class="form-group">
						<label>Sub Total</label><br>
						<span id="subtotal">Rp 0,-</span>
					    
					</div>
</div>
			</div>
	  </form>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="tmb" onclick="lanjutkan()" disabled="" >Lanjutkan</button>
      </div>
    </div>

  </div>
</div>

<?php $link = explode('-',$idlink);?>
<script type="text/javascript">
	$( document ).ready(function() {
	var id_alamat = $("#id_alamat").val();
	$.ajax({
			type: "POST",
			url : "<?=site_url('Home_controller/getinfoalamat');?>",
			data : "id_alamat="+id_alamat,
			success : function(msg){
				$(".info-alamat").show();
				$(".info-alamat").html(msg);
			}
		});
		$("#id_alamat").change(function(){
			var id_alamat = $("#id_alamat").val();
			var str_alamat = $();
			$.ajax({
				type: "POST",
				url : "<?=site_url('Home_controller/getinfoalamat');?>",
				data : "id_alamat="+id_alamat,
				success : function(msg){
					$(".info-alamat").show();
					$(".info-alamat").html(msg);
				}
			})
		});
		
		
     var min =  $("#min").val();
		var max =  $("#max").val();
		var produk =  $("#produk").val();
		var urut =  $("#urut").val();
		var kategori = <?php echo $link[1];?>;
		var provinsi = $("#provinsi").val();
		var kota = $("#kota").val();
		//alert("as");
		//cari();

});
	$(".loader").fadeOut();
$(function() {
		 $("#min").change(function(){
		 var min =  $("#min").val();
		var max =  $("#max").val();
		var produk =  $("#produk").val();
		var urut =  $("#urut").val();
		var kategori = <?php echo $link[1];?>;
		var provinsi = $("#provinsi").val();
		var kota = $("#kota").val();

		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianKategori/',
            data: "min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota+"&halaman="+<?php echo $halamann;?>+"&A="+<?php echo $A;?>,
             beforeSend: function(data){
        		$("#loadingcari").fadeIn();
      		},
            success: function(data){
            	//alert(provinsi);
				
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
	 $("#max").change(function(){
	 var min =  $("#min").val();
	 var max =  $("#max").val();
	var produk =  $("#produk").val();
	var urut =  $("#urut").val();
	var kategori = <?php echo $link[1];?>;
	var provinsi = $("#provinsi").val();
	 var kota = $("#kota").val();
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianKategori/',
            data: "min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota+"&halaman="+<?php echo $halamann;?>+"&A="+<?php echo $A;?>,
              beforeSend: function(data){
        		$("#loadingcari").fadeIn();
      		},
            success: function(data){
            	//alert(provinsi);
				
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
	  $("#produk").change(function(){
	 var min =  $("#min").val();
	 var max =  $("#max").val();
	var produk =  $("#produk").val();
	var urut =  $("#urut").val();
	var kategori = <?php echo $link[1];?>;
	var provinsi = $("#provinsi").val();
	 var kota = $("#kota").val();
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianKategori/',
            data: "min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota+"&halaman="+<?php echo $halamann;?>+"&A="+<?php echo $A;?>,
              beforeSend: function(data){
        		$("#loadingcari").fadeIn();
      		},
            success: function(data){
            	//alert(provinsi);
				
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
	    $("#urut").change(function(){
	 var min =  $("#min").val();
	 var max =  $("#max").val();
	var produk =  $("#produk").val();
	var urut =  $("#urut").val();
	var kategori = <?php echo $link[1];?>;
	var provinsi = $("#provinsi").val();
	var kota = $("#kota").val();
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianKategori/',
            data: "min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota+"&halaman="+<?php echo $halamann;?>+"&A="+<?php echo $A;?>,
              beforeSend: function(data){
        		$("#loadingcari").fadeIn();
      		},
            success: function(data){
            	//alert(provinsi);
				
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
	    	  $("#provinsi").change(function(){
	 var min =  $("#min").val();
	 var max =  $("#max").val();
	var produk =  $("#produk").val();
	var urut =  $("#urut").val();
	var kategori = <?php echo $link[1];?>;
	var provinsi = $("#provinsi").val();
	var kota = "semua";
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianKategori/',
            data: "min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota+"&halaman="+<?php echo $halamann;?>+"&A="+<?php echo $A;?>,
             beforeSend: function(data){
        		$("#loadingcari").fadeIn();
      		},
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
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
$("#kota").change(function(){
	 var min =  $("#min").val();
	 var max =  $("#max").val();
	var produk =  $("#produk").val();
	var urut =  $("#urut").val();
	var kategori = <?php echo $link[1];?>;
	var provinsi = $("#provinsi").val();
	var kota = $("#kota").val();
		 $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianKategori/',
            data: "min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota+"&halaman="+<?php echo $halamann;?>+"&A="+<?php echo $A;?>,
               beforeSend: function(data){
        		$("#loadingcari").fadeIn();
      		},
            success: function(data){
            	//alert(provinsi);
				
				 $("#result").html(data);
				 $("#loadingcari").fadeOut();
				 $("#paginationn").hide();
             }
         });
	 });
});
function beli(idpro)
	{
		 $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/modal'); ?>",
            cache :false,
            dataType: "json",
            data: "id_produk=" + idpro,
            success : function(msg) {
            	$("#nama_barang").html(msg['NM_PRODUK']).show();
            	$("#id_produk").val(msg['ID_PRODUK']);
            	$("#id_produktext").val(msg['ID_PRODUK']);
            	if(msg['STS_GROSIR']==1)
            	{
            		var harga = msg['HARGA'];
            		var res = harga.split("|");
            		var ke2 = res[0].split("-");
            		$("#harga").html(ke2[2]).show();
            	}
            	else
            	{
            		$("#harga").html(msg['HARGA']).show();
            	}
            	
            	$("#hargatext").val(msg['HARGA']);
            	$('#myModal').modal('show');
            },
            error : function() {
                
            }
        });
    	return false;
	}
		function order() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/to_cart'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val(),
            success : function(msg) {
            	if(msg==1)
            	{
            		alert("Add to Cart Success.");
            	}
            	else if (msg==2)
            	{
            		alert("Update to Cart Success.");
            	}
            	else
            	{
            		alert("Do Not Input 0.");
            	}
            	hitung();
            },
            error : function() {
                
            }
        });
    return false;
    }
      $("#qty").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
           function do_hitung(){
     	if($("#qty").val()!=0)
     	{
     		///alert("asuk");
	     	$.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('user_cart/hitungqty'); ?>",
	            cache :false,
	            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val(),
	            success : function(msg) {
	            	$("#hargatext").val(msg);
	            	$("#harga").html(msg).show();
	            	if($("#ong").val())
	            	{
	            		if($("#ong").val()!=0)
	            		{
	            		do_hitung_uange();
	            		}
	            	}
	            },
	            error : function() {
	                
	            }
	        });
	    	return false;
    	}
    	else
    	{
    		//alert("asuk");
    		if($("#qty").val())
    		{
				$('#qty').val(1);
    		}
    		else
    		{
    			$('#qty').val(1);
    		}
	    	$.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('user_cart/hitungqty'); ?>",
	            cache :false,
	            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val(),
	            success : function(msg) {
	            	$("#hargatext").val(msg);
	            	$("#harga").html(msg).show();
	            	if($("#ong").val())
	            	{
	            		if($("#ong").val()!=0)
	            		{
	            		do_hitung_uange();
	            		}
	            	}
	            },
	            error : function() {
	                
	            }
	        });
	    	return false;
    	}
     }
         function do_hitung_uang(){
     	$(".loader").fadeIn();
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_hitung_uang'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val()+ "&kurir=" + $('#kurir').val()+ "&id_alamat=" + $('#id_alamat').val(),
            success : function(msg) {
            	$("#ongkir").html(msg).show();
            	$("#a").html("-").show();
            	if($("#kurir").val()==0)
            	{
            		$('#tmb').prop("disabled", true);	
            	}
            	$(".loader").fadeOut();
            },
            error : function() {
                $(".loader").fadeOut();
            }
        });
    	return false;
     }
          function do_hitung_uange(){
     	$(".loader").fadeIn();
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_hitung_uange'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val()+ "&kurir=" + $('#kurir').val()+ "&id_alamat=" + $('#id_alamat').val()+ "&ong=" + $('#ong').val(),
            success : function(msg) {
            	var fo = formatRupiah(msg);
            	var result = msg.split('#');
            	$("#hargapengiriman").val(result[0]);
            	do_hitung_all();
            	if($("#ong").val()!=0)
            	{
            		$('#tmb').prop("disabled", false);	
            	}
            	else
            	{
            		$('#tmb').prop("disabled", true);	
            	}
            	$(".loader").fadeOut();
            },
            error : function() {
                $(".loader").fadeOut();
            }
        });
    	return false;
     }
        function do_hitung_all(){
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_hitung_all'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val()+ "&hargapengiriman=" + $('#hargapengiriman').val(),
            success : function(msg) {
            	$("#subtotal").html(msg).show();
            },
            error : function() {
                
            }
        });
    	return false;
     }
     function tambahalamat(){
     	$("#alamatdropdown").hide();
     	$("#tambahkanalamat").show();
     	$("#simpansebagai").val('');
     	$("#alamat").val('');
     	$("#nama_penerima").val('');
     	$("#no_hp_penerima").val('');
     	$("#kode_pos").val('');
     	$("#id_provinsi").val('');
     	$("#id_kota").val('');
     }
     function kembali(){
     	$("#alamatdropdown").show();
     	$("#tambahkanalamat").hide();
     }
     $("#id_provinsi").change(function(){
        var id_provinsi = $("#id_provinsi").val();
        $("#sts").html('Loading kota...');
        $.ajax({
            url: "<?php echo base_url('user_cart/getKota') ?>",
            type : "POST",
            data: "id_provinsi=" + id_provinsi,
            cache: false,
            success: function(msg){
                 $("#sts").html('');
                $("#id_kota").html(msg);
            }
        });
    });
     function do_alamat() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_alamat'); ?>",
            cache :false,
            data: "alamat="+$("#alamat").val()+"&simpansebagai="+$("#simpansebagai").val()+"&nama_penerima="+$("#nama_penerima").val()+"&no_hp_penerima="+$("#no_hp_penerima").val()+"&kode_pos="+$("#kode_pos").val()+"&id_provinsi="+$("#id_provinsi").val()+"&id_kota="+$("#id_kota").val(),
            success : function(msg) {
            	kembali();
                	$.ajax( {
			            type :"POST",
			            url :"<?php echo site_url('user_cart/isidropdown'); ?>",
			            cache :false,
			            success : function(msg) {
			            	$("#id_alamat").html(msg);
			            },
			            error : function() {
			                
			            }
			        });
			    	return false;

            },
            error : function() {
                
            }
        });
        return false;
    }
    function alamat_stts() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/alamat_stts'); ?>",
            cache :false,
            data: "id_alamat="+$("#id_alamat").val(),
            success : function(msg) {
                if($("#id_alamat").val()==0)
                {
                	$('#tmb').prop("disabled", true);	
                }
                else
                {
                	$("#kurir").val(0);
                	$("#ong").val(0);
                	$("#a").html("").show();
                	$("#hargapengiriman").val(0);
                	$("#subtotal").html("Rp 0,-").show();
                	$('#tmb').prop("disabled", true);	
                }
            },
            error : function() {
                
            }
        });
        return false;
    }
    function lanjutkan() {
    	$(".loader").fadeIn();
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/to_cart'); ?>",
            cache :false,
            data: "id_produktext="+$("#id_produktext").val()+"&qty="+$("#qty").val()+"&id_alamat="+$("#id_alamat").val()+"&kurir="+$("#kurir").val()+"&ong="+$("#ong").val()+"&hargapengiriman="+$("#hargapengiriman").val(),
            success : function(msg) {
            	//alert(msg);
                if(msg==1)
            	{
            		//alert("Sukses menambah ke keranjang belanja.");
            	}
            	else if (msg==2)
            	{
            		//alert("Keranjang berhasil diperbaharui.");
            	}
            	else
            	{
            		alert("Do Not Input 0.");
            	}
            	$("#myModal").modal("hide");
            	$(".loader").fadeOut();
            	location.reload();
            },
            error : function() {
                
            }
        });
        return false;
    }
    function formatRupiah(nominal)
    {
    	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/formatRupiah'); ?>",
            cache :false,
            data: "nominal="+nominal,
            success : function(msg) {
                $("#a").html(msg).show();
            },
            error : function() {
                
            }
        });
        return false;
    }
    function formatHarga(nominal)
    {
    	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/formatHarga'); ?>",
            cache :false,
            data: "nominal="+nominal,
            success : function(msg) {
                $("#harga").html(msg).show();
            },
            error : function() {
                
            }
        });
        return false;
    }

</script>