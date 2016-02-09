<?php $link = site_url('assets/images/page-loader.gif'); 
	$tot_pj_semua = 0;
	$tot_ind_semua = 0;
?>

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

<?php if($this->session->flashdata('notif')): ?>

<div class="col-md-12">

	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">

		<i class="fa fa-check"></i>

		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

		<?php echo $this->session->flashdata('notif'); ?>

	</div>

</div>



	<?php endif; ?>



	<form id="cok" method="POST">

	<input type="hidden" name="no_trans" value="<?php echo $pembeli->NO_TRANS; ?> "><!-- Ini UNTUK nO Trans -->

	<input type="hidden" name="id_trans" value="<?php echo $pembeli->ID_TRANS; ?> " id="id_trans"><!-- Ini UNTUK nO Trans -->

<!-- 	<div class="col-md-12">

		<div class="panel panel-default">

			<div class="panel-body">

				<h4>Orderan Baru</h4>

					<hr style="border-color: #ABABAB;">

				

				<div class="form-group">

					<label>Status</label>

					<p><?php echo $pembeli->STATUS; ?></p>

				</div>

				<div class="form-group">

					<label>Nama Pembeli</label>

					<p><?php echo $pembeli->NAMA; ?></p>

				</div>

				<div class="form-group">

					<label>Alamat</label>

					<p><?php echo $pembeli->ALAMAT; ?></p>

				</div>

				<div class="form-group">

					<label>No HP</label>

					<p><?php echo $pembeli->NO_HP; ?></p>

				</div>

			</div>

		</div>

	</div> -->

	<?php  $ss = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$pembeli->NO_TRANS'")->row(); 

	if($ss)

	{

	?>	

	

	<?php }

	else 

	{?>

	

	<?php }

		?>

	<div class="col-md-12">

		

				<?php 

				$pjs=0;

				$tg=0;

				$aslitot=0;

		foreach ($toko as $tok) { ?>

		<div class="panel panel-default">
			<div class="panel-heading">
			<h4 align="center">ORDERAN BARU</h4>
			</div>
			<div class="panel-body">

				
			<div class="row">
				<div class="col-md-8">
					<table >
						<tr>
							<td><label>ID Transaksi</label></td>
							<td style="padding:10px;">:</td>
							<td><?php echo $id; ?></td>
						</tr>
						<tr>
							<td><label>Tanggal Transaksi</label></td>
							<td style="padding:10px;">:</td>
							<td><?php echo $pembeli->TGL_TRANS; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-4">
					<?php 
						if($tok->STATUS_TERSEDIA==1)
							{ 
					?>

								<input type="hidden" name="id_toko[]" value="<?php echo $tok->ID_TOKO; ?>">

					<?php 
							} 


					$datanya = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO='$tok->ID_TOKO' GROUP BY ID_ALAMAT_PENERIMA")->result();

					$tot_harga=0;

					$tot_ongkir=0;

					$pj_tot=0;

					$web_tot=0;

					$ongkir=0;

					$ku_web=0;

					$ku_pj=0;

					$tot_harga2=0;

					$tot_asli=0;

					$tot_berat_paling_akhir = 0;

					$tot_stok = 0;

					?>

					<label>Bila Stok Hanya Tersedia Sebagian :</label> 
					<h4>
						<?php

						if($tok->STATUS_TERSEDIA==1)

						{

							echo "<b style='color:green'>KIRIM YANG TERSEDIA</b>";

						}

						else if($tok->STATUS_TERSEDIA==0)

						{

							echo "<b style='color:red'>BATALKAN TRANSAKSI</b>";

						}

						?>
					</h4>
				
				</div>
			</div>
				

				
				<hr style="border-color: #dddddd;">		
						

			



			

			<?php foreach($datanya as $deta){

			?>

				<h4>Informasi Penerima</h4>
				<table class="table table-striped">
				<tr>
					<td><label>Nama</label></td>
					<td style="padding:3px">:</td>
					<td><?php echo $deta->NAMA_PENERIMA; ?></td>
				</tr>
				<tr>
					<td><label>Alamat</label></td>
					<td style="padding:3px">:</td>
					<td><?php echo $deta->ALAMAT_PENERIMA; ?></td>
				</tr>
				<tr>
					<td><label>Telp</label></td>
					<td style="padding:3px">:</td>
					<td><?php echo $deta->NO_HP_PENERIMA; ?></td>
				</tr>
				</table>
				 
				<br/>

			<?php

			$variable = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TOKO = '$tok->ID_TOKO' AND NO_TRANS = '$tok->NO_TRANS'   GROUP BY ID_ONGKIR")->result();
			//echo $this->db->last_query();
			foreach ($variable as $key ) 

			{

			$haha = $this->db->query("SELECT COUNT(*) AS A FROM view_detail_transaksi WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->row();

			if($haha->A>0)

			{

				$lala=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->result();

			?>

				<table id="example1" class="table table-bordered table-striped">

		        <thead style="background:#d9ffac">

		        	<tr align="center">

						<th>No</th>

						<th>Produk</th>

						<th>Jumlah Dipesan</th>

						<th>Berat Satuan</th>

						<th>Harga Satuan</th>


						<?php if($tok->STATUS_TERSEDIA==1){ ?>

						<th>Stok Tersedia</th>

						<?php } ?>

						<th>Total Berat</th>

						<th>Total Harga Dipesan</th>

						<!--<th>Keu WEB</th>-->

						<!--<th>Keu PJ</th>-->
						<th>Potongan Indobaba 10%</th>

					</tr>

		        </thead>

			       <tbody>

			    	<?php 

			    	$no = 1;

			    	$tot_web=0;

			    	$tot_pj=0;

			    	$tot_akh=0;

			    	$tot_akh_ongkir=0;

			    	$tot_berat_awal = 0;

			    	$tot_berat_akhir = 0;

			    	$tot_akh2=0;

			    	$totalasli=0;

			    	foreach($lala as $detail){ $potongan = 0;?>

			    	<tr align="center">

			    		<td><?php echo $no++; ?></td>

						<td><?php echo $detail->NM_PRODUK; ?></td>

						<td><?php $tot_stok = $tot_stok + $detail->QTY; echo $detail->QTY;?> buah</td>

						<td><?php echo konversiGram($detail->BERAT_PRODUK); ?></td>

						<td><?php echo formatRp($detail->HARGA_PER); ?></td>

						<?php if($tok->STATUS_TERSEDIA==1){ ?>

						<td>
						<?php if($detail->STS_TANGGAP==0){
							$tpxx = "";
							}else{ 
								$tpxx = "readonly=''";
							}?>
																																									<!--onchange="updatestok(<?php echo $detail->ID_CART;?>)"-->		
							<input <?php echo $tpxx;?> type="text" value="<?php echo $detail->QTY_TERSEDIA; ?>" id="qtytersedia[]" class="qtysedia<?php echo $detail->ID_CART; ?> nuaa"  onkeyup="qtysedia(<?php echo $detail->QTY; ?>,<?php echo $detail->ID_CART; ?>)"  name="qtytersedia<?php echo $tok->ID_TOKO ?>[]" required/>	
						

						</td>

						<?php } ?>
						<td><?php $tot_berat_awal = $detail->BERAT_PRODUK*$detail->QTY_TERSEDIA; echo konversiGram($tot_berat_awal);$tot_berat_akhir = $tot_berat_akhir + $tot_berat_awal; ?></td>

						

						<?php

						 $totharga2 = $detail->HARGA_PER*$detail->QTY_TERSEDIA; 

						?>

						<td><?php 

						$tot_akh2 += $totharga2;

						echo formatRp($totharga2); 

						?></td>

						<td>

						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 

							  $keuntungan1 =($keu->KEUNTUNGAN_UKM/100)*$totharga2;

							  $tot_web+=$keuntungan1;

							 	//echo formatRp($keuntungan1);

						?>

						<!--</td>-->

						<!--<td>-->

						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 

							  $keuntungan2 =($keu->KEUNTUNGAN_PJ/100)*$totharga2;

							  $tot_pj+=$keuntungan2;

							  //echo formatRp($keuntungan2);
							  echo formatRp($potongan = $keuntungan1 + $keuntungan2);

						?>

						</td>

						<?php $asli = $detail->HARGA_PER*$detail->QTY;  $totalasli+=$asli;  //echo $asli; ?>

						

						<input type="hidden" value="<?php echo $detail->ID_CART; ?>" id="cart" class="cart[]" name="cart<?php echo $tok->ID_TOKO ?>[]" required/>

					<tr>

			    	<?php } ?>

			       </tbody>

			       <tfoot>

			       	<tr align="center">

			       		<?php if($tok->STATUS_TERSEDIA==1){ ?>

			       		<td colspan="6">Jumlah</td>

			       		<?php }

			       		else{ ?>

			       		<td colspan="5">Jumlah</td>

			       		<?php } ?>
			       		<td><?php $tot_berat_paling_akhir = $tot_berat_paling_akhir + $tot_berat_akhir;echo konversiGram($tot_berat_akhir);?></td>

			       		<td><?php $tot_harga2+=$tot_akh2; echo formatRp($tot_akh2);?></td>

			       		<td><?php $tot_pj;$tot_ind_semua = $tot_ind_semua + $tot_web;$ku_web += $tot_web; //echo formatRp($tot_web); ?>

			       		<?php $tot_pj;$tot_pj_semua = $tot_pj_semua + $tot_pj;$ku_pj += $tot_pj; echo formatRp($tot_web+$tot_pj);  ?></td>

			       		<?php $tot_asli += $totalasli; //echo $totalasli;  ?>

			       		

			       		

			       	</tr>

			       	<tr style="background:#d9ffac">

			       		<?php if($tok->STATUS_TERSEDIA==1){ ?>

			       		<td colspan="10" style="color:black;font-size:12pt">

			       		<?php }

			       		else{ ?>

			       		<td colspan="9" style="color:black;font-size:12pt">

			       		<?php } ?>

			       		<b>

			       		Produk diatas dikirim dengan kurir : <?php echo strtoupper($key->NAMA_KURIR)." - ".$key->PAKET_YANG_DIAMBIL; ?>

	    				<?php if($tok->STATUS_TERSEDIA==1)

						{ ?>

	    				<input type="hidden" name="ongkir[]" value="<?php echo $key->ID_ONGKIR; ?>">

	    				<?php } ?><?php 

	    				$ongkir+=$key->TOTAL_ONGKIR_REALISASI; ?>

			       		<?php

	    				echo "(".formatRp($key->TOTAL_ONGKIR_REALISASI).")";

	    				 ?>

	    				 </b>
	    				 <?php if($detail->STS_TANGGAP==1 AND $detail->STATUS_TERSEDIA == 1){	?>
	    				 <a href="#" style="float: right;" class="btn btn-info" onclick="batalkanini(<?php echo $tok->ID_TOKO; ?>,<?php echo $key->ID_ONGKIR; ?>)">Ubah Stok Tersedia</a>
						 <?php }?>	
			       	
	    				 </td>

			       	</tr>
			       	<?php if($detail->STS_TANGGAP==1 AND $key->STS_TAMPIL==1){	?>
			       	<tr>
			       	<td colspan="10">
							<div class="form-group">

								<label>Masukkan Resi : </label>

								<?php $q=$this->db->query("SELECT * FROM mp_cart WHERE ID_TRANS='$pembeli->ID_TRANS' AND ID_ONGKIR='$key->ID_ONGKIR'")->row(); ?>

							 	<input type="text" class="form-control" style="width:300px;display: initial;" value="<?php if($q) echo $q->RESI; ?>" required  id='resi<?php  echo $key->ID_ONGKIR ?>' class="resi[]" onchange="resi(<?php echo $key->ID_ONGKIR; ?>)"> 
								<div style="display: -webkit-inline-box;"id="theDiv<?php  echo $key->ID_ONGKIR ?>"></div>
								<img id="centang<?php  echo $key->ID_ONGKIR ?>" src="<?php echo base_url();?>assets/centang.png" style="width:20px;<?php if($q->RESI == ''): ECHO 'Display:none'; else: echo 'display:-webkit-inline-box';endif;?>">
								
							</div>

							<!--<a href="#" onclick="resi(<?php echo $key->ID_ONGKIR; ?>)" class="btn btn-success">Kirim Resi</a>-->
	    				 </td>
			       	</tr>
			       	<?php }else{ echo "<tr><td colspan='10'>";?>
			       	<?php
			
		         if($tok->STATUS_TERSEDIA==1)

				 { ?>

				 <!--<input type="submit" value="Simpan" class="btn btn-success">-->
				 <?php //echo $key->ID_ONGKIR; ?>

				 <a href="#" onclick="aaaa(<?php echo $tok->ID_TOKO; ?>,<?php echo $key->ID_ONGKIR; ?>)" class="btn btn-success">Simpan Stok Tersedia</a>

		         <?php }


		         elseif($tok->STATUS_TERSEDIA==0)

		         {?>
		     	<div style="border-left: 5px solid #FF0000;background: rgb(255, 227, 24);padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
		     	Jika permintaan diatas tidak bisa dikirim semua, silahkan klik tombol "Batalkan Transaksi"
		     	</div>

				<!--<a href="#" onclick="bbb(<?php echo $tok->ID_TOKO; ?>)" class="btn btn-danger">Batalkan Transaksi</a>-->

		         <?php } echo "</td></tr>";}?>


			       </tfoot>

		        </table>

				</table>

		         <?php

		     }

		}
		?>
		<br/>
			<table>
				<tr>
					<td style="padding:8px"><label>Total Item</label></td>
					<td style="padding:8px">:</td>
					<td style="padding:8px"><?php echo $tot_stok;?> buah</td>
				</tr>
				<tr>
					<td style="padding:8px"><label>Total Ongkos Kirim</label></td>
					<td style="padding:8px">:</td>
					<td style="padding:8px"><?php echo formatRp($ongkir); ?></td>
				</tr>
				<tr>
					<td style="padding:8px"><label>Total Berat</label></td>
					<td style="padding:8px">:</td>
					<td style="padding:8px"><?php echo konversiGram($tot_berat_paling_akhir);?></td>
				</tr>
			</table>
		<br/>  
		



		<hr/>

		

			<?php 

			}

			?>		        
			<table >
			<tr>
				<td ><strong>Total Tagihan ke Indobaba</strong></td>
				<td style="padding:4px">:</td>
				<td style="font-size:30px; color: #688744"><?php echo formatRp(($tot_harga2-($ku_web+$ku_pj))+$ongkir); ?></td>
			</tr>
			</table>
		         

			</div>

		</div>

			<?php

		}

		 ?>

		  <div class="row">

        	<div class="col-md-6">

        		<div class="panel panel-default">

        		</div>

        	</div>

        	<div class="col-md-6">

        		<div class="panel panel-default">

        			<div class="panel-body" style="display:none">

        			<!-- 	<h2><?php echo formatRp($aslitot-$tg); $saldo=$aslitot-$tg; ?></h2> -->

        			</div>

        		</div>

        	</div>

		  </div>

		  <div class="row">

		        	<div class="col-md-6">
		        	<?php $tot_pj_semua." ".$tot_ind_semua;if($tok->STATUS_TERSEDIA==0){
		        	if($tok->STS_TANGGAP==0)
					{

		         ?>

		        			<a href="#" onclick="ccc(<?php echo $tok->ID_TOKO; ?>,<?php echo $key->ID_ONGKIR; ?>)" class="btn btn-success">Kirim Barang</a>
		

				 <a href="#" onclick="bbb(<?php echo $tok->ID_TOKO; ?>)" class="btn btn-danger">Batalkan Transaksi</a>

		         <?php } else{ ?>
		         <a href="#" class="btn btn-danger" onclick="batalkirimbarang(<?php echo $tok->ID_TOKO; ?>)" >Batal</a>
						

		         <?php }} ?>

		        			<a href="<?php echo site_url('ukm_info/orderan'); ?>" onclick="keluar()"  class="btn btn-info">Kembali</a>

		        	</div>

		  </div>

		 	

	</div>

	</form>

	<script>

    hituung();

	tghn();
	
	function keluar(){

		window.close();

	}


	function hituung()

	{



		 $.ajax( {

              type :"POST",

              url :"<?php echo site_url('ukm_info/hituung') ?>",

              cache :false,

              data: "tg=" + <?php echo $tg; ?> +  "&kode=" + <?php echo $ss->KODE_UNIK; ?>,

              success : function(msg) {

                 $("#nominalnya").html(msg).show();

              },

              error : function() {

                  //$('#data_s3').replaceWith('Error');

              }

          });



	}

	function tghn()

	{

		 $.ajax( {

              type :"POST",

              url :"<?php echo site_url('ukm_info/tghn') ?>",

              cache :false,

              data: "tg=" + <?php echo $tg; ?>,

              success : function(msg) {

                 $("#tghn").html(msg).show();

              },

              error : function() {

                  //$('#data_s3').replaceWith('Error');

              }

          });



	}

	$("#cok").submit( function() {

        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/do_tersedia'); ?>",

            cache :false,

            data: $( "#cok" ).serialize(),

            success : function(msg) {

              alert(msg);

            },

            error : function() {

               

            }

        });

    return false;

    });

   function aaaa(idtoko,idongkir)  

   {

   	$(".loader").fadeIn();

        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/do_tersedia'); ?>",

            cache :false,

            data: $( "#cok" ).serialize()+"&tokonya="+idtoko+"&ongkirs="+idongkir,

            success : function(msg) {

              $(".loader").fadeOut();

              alert("Berhasil menyimpan data.");
              //alert(msg);

              window.location.reload();

            },

            error : function() {

               

            }

        });

    return false;

    } 

    function bbb(idtoko) 

   {

   	//var values = $("input[id='cart']").map(function(){return $(this).val();}).get();
   	if(confirm("Apakah Anda yakin ?"))

   	{

        $(".loader").fadeIn();

        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/do_batal'); ?>",

            cache :false,

            data: "&tokonya="+idtoko+"&"+$( "#cok" ).serialize(),

            success : function(msg) {

              $(".loader").fadeOut();

              alert("Berhasil menghapus data.");

             window.location.href="<?php echo site_url('ukm_info/orderan/5'); ?>";

            },

            error : function() {

               

            }

        });

    return false;
	}

    } 

    function ubahstatus() 

   {

   	if(confirm("Pastikan Jumlah Barang Sudah Valid , Karena Sistem Otomatis Update Saldo. Jika Belum Valid Tekan Cancel."))

   	{

        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/ubahstatus'); ?>",

            cache :false,

            data: "no_trans="+<?php echo $pembeli->NO_TRANS; ?>+"&id_trans="+$("#id_trans").val()+"&saldo="+<?php echo $saldo; ?>+"&pembeli="+<?php echo $pembeli->ID_AKUN; ?>,

            success : function(msg) {

              alert("Berhasil menyimpan data.");

			  //alert(msg);

              window.location.href="<?php echo site_url('ukm_info/orderan/3'); ?>";

            },

            error : function() {

               

            }

        });

    	return false;

    }

	}

	$(window).load(function() {

    $(".loader").fadeOut(500);

	})



	$(".nuaa").keypress(function (e) {

		     //if the letter is not digit then display error and don't type anything

		     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {

		        //display error message

		        $("#errmsg").html("Digits Only").show().fadeOut("slow");

		               return false;

		    }

		  });



	function qtysedia(qty,cart)

	{

		if($(".qtysedia"+cart).val()>qty)

		{

			$(".qtysedia"+cart).val(qty);

		}

	}
	function updatestok(e){
		$.ajax( {
            type :"POST",
            url :"<?php echo site_url('ukm_info/updatestok/'); ?>",
            cache :false,
            data: "id_cart="+e+"&stok="+$(".qtysedia"+e).val(),
            success : function(msg) {
   				alert("berhasil di ubah.");
            },
            error : function() {
            	alert("gagal.silahkan ulangi lagi.");
            	window.location.reload();
            }

        });

	}
	 function resi(id_ongkir) 

   {
   	//alert($("#resi"+id_ongkir).val());
   	//alert(id_ongkir);
   		//$('#theDiv'+id_ongkir).prepend('<img src="<?php echo base_url();?>assets/ajax-loader.gif" style="width:20px">')
  
        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/isiresi'); ?>",

            cache :false,

            data: "tot_pj="+<?php echo $tot_pj_semua;?>+"&tot_web="+<?php echo $tot_ind_semua;?>+"&no_trans="+<?php echo $pembeli->NO_TRANS; ?>+"&id_ongkir="+id_ongkir+"&id_trans=<?php echo $pembeli->ID_TRANS; ?>&resi="+$("#resi"+id_ongkir).val(),

            success : function(msg) {
            	//alert(<?php echo $tot_pj_semua;?>);
            	//alert(<?php echo $tot_ind_semua;?>);

            $('#theDiv'+id_ongkir).fadeIn();
            	if($("#resi"+id_ongkir).val() == ""){
            		$('#centang'+id_ongkir).hide();
            	}
            	else{
            		$('#centang'+id_ongkir).show();
            	}
			$('#theDiv'+id_ongkir).fadeOut();
			 if(msg == "1"){
            	alert("Berhasil transaksi telah lengkap.");
            	window.location.href="<?php echo site_url('ukm_info/orderan/4'); ?>";
            }


            },

            error : function() {

               

            }

        });
      

    return false;

    }
    function batalkanini(idtoko,idongkir) 
   	{
   		$(".loader").fadeIn();
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('ukm_info/batalkanini'); ?>",
            cache :false,
            data: $( "#cok" ).serialize()+"&tokonya="+idtoko+"&ongkirs="+idongkir,
            success : function(msg) {
              $(".loader").fadeOut();
              alert("Stok tersedia dapat anda ubah !");
              window.location.reload();
            },
            error : function() {
               
            }
        });
    return false;
    }
    function ccc(idtoko) 
   {
	        $(".loader").fadeIn();
	        $.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('ukm_info/do_kirimkan'); ?>",
	            cache :false,
	            data: "tokonya="+idtoko+"&"+$( "#cok" ).serialize(),
	            success : function(msg) {
	              alert("Berhasil Mengirimkan Barang.");
	              $(".loader").fadeOut();
	              window.location.reload();
	            },
	            error : function() {
	               
	            }
	        });
	    	return false;
    }
     function batalkirimbarang(idtoko) 
   {
	        $(".loader").fadeIn();
	        $.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('ukm_info/batalkirimbarang'); ?>",
	            cache :false,
	            data: "&tokonya="+idtoko+"&"+$( "#cok" ).serialize(),
	            success : function(msg) {
	              $(".loader").fadeOut();
	              window.location.reload();
	            },
	            error : function() {
	               
	            }
	        });
	    	return false;
    }


	</script>