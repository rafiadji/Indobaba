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




	<div class="col-md-12">

		

				<?php 

				$pjs=0;

				$tg=0;

		foreach ($toko as $tok) { ?>

		<div class="panel panel-default">
			<div class="panel-heading">
			<h4 align="center">ISI KODE RESI KURIR PENGIRIMAN</h4>
			</div>
			<div class="panel-body">

			<!-- <h3>Produk Yang di Pesan</h3>

			<?php if($tok->STATUS_TERSEDIA==1)

				{ ?>

			<input type="hidden" name="id_toko[]" value="<?php echo $tok->ID_TOKO; ?>">

				<?php } ?>

			<div class="form-group">

				

					

			</div>

			<hr/>
 -->
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
					echo $this->db->last_query();
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
			<?php  $ss = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$pembeli->NO_TRANS'")->row();?>
				

				
				<hr style="border-color: #dddddd;">		

			

			<?php foreach($datanya as $deta)
			{

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

			$variable = $this->db->query("SELECT * FROM mp_ongkir")->result();

			foreach ($variable as $key ) 

			{

			$haha = $this->db->query("SELECT COUNT(*) AS A FROM view_detail_transaksi WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->row();

			if($haha->A>0)

			{

				$lala=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->result();

			?>

				<table id="example1" class="table table-bordered table-striped">

		        <thead>

		        	<tr style="background:#d9ffac">

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

						<!--<th>Keu WEB</th>

						<th>Keu PJ</th>-->
						<th>Potongan Indobaba 10%</th>

					</tr>

		        </thead>

			       <tbody>

			    	<?php 

			    	$no = 1;

			    	$tot_web=0;

			    	$tot_pj=0;

			    	$tot_akh=0;

			    	$tot_berat_awal = 0;

			    	$tot_berat_akhir = 0;

			    	$tot_akh_ongkir=0;

			    	$tot_akh2=0;

			    	foreach($lala as $detail){  $potongan = 0;?>

			    	<tr>

			    		<td><?php echo $no++; ?></td>

						<td><?php echo $detail->NM_PRODUK; ?></td>

						<td><?php $tot_stok = $tot_stok + $detail->QTY; echo $detail->QTY;?> buah</td>

						<td><?php echo konversiGram($detail->BERAT_PRODUK); ?></td>

						<td><?php echo formatRp($detail->HARGA_PER); ?></td>

						
						<?php if($tok->STATUS_TERSEDIA==1){ ?>

						<td>

							<?php echo $detail->QTY_TERSEDIA; ?>

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

						<input type="hidden" value="<?php echo $detail->ID_CART; ?>" id="cart" class="cart[]" name="cart[]" required/>

					<tr>

			    	<?php } ?>

			       </tbody>

			       <tfoot>

			       	<tr>

			       		<?php if($tok->STATUS_TERSEDIA==1){ ?>

			       		<td colspan="6" align="center">Jumlah</td>

			       		<?php }

			       		else{ ?>

			       		<td colspan="5">Jumlah</td>

			       		<?php } ?>
			       		<td><?php $tot_berat_paling_akhir = $tot_berat_paling_akhir + $tot_berat_akhir;echo konversiGram($tot_berat_akhir);?></td>

			       		<td><?php $tot_harga2+=$tot_akh2; echo formatRp($tot_akh2);?></td>

			       		<td><?php $ku_web += $tot_web; //echo formatRp($tot_web); ?>

			       			<?php $ku_pj += $tot_pj; echo formatRp($tot_web+$tot_pj);  ?></td>


			       		

			       		

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

	    				$ongkir+=$key->TOTAL_REALISASI; ?>

			       		<?php

	    				echo "(".formatRp($key->TOTAL_REALISASI).")";

	    				 ?>

	    				 	

	    				 </b>

	    				 </td>
	    				 

			       	</tr>
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

			       </tfoot>

		        </table>

				</table>

		         <?php

		     }

		}

		    
			}

			?>



			        
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

			<hr/>

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

		        			<a href="#" onclick="resivalid()" class="btn btn-success">Resi Valid</a>

		        			<a href="<?php echo site_url('ukm_info/orderan'); ?>" onclick="keluar()" class="btn btn-danger">Kembali</a>

		        		</div>

		        	</div>

		  </div>	

	</div>

</form>

<script type="text/javascript">

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

    function resi(id_ongkir) 

   {
   	//alert($("#resi"+id_ongkir).val());
   	//alert(id_ongkir);
   		//$('#theDiv'+id_ongkir).prepend('<img src="<?php echo base_url();?>assets/ajax-loader.gif" style="width:20px">')
  
        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/isiresi'); ?>",

            cache :false,

            data: "no_trans="+<?php echo $pembeli->NO_TRANS; ?>+"&id_ongkir="+id_ongkir+"&id_trans=<?php echo $pembeli->ID_TRANS; ?>&resi="+$("#resi"+id_ongkir).val(),

            success : function(msg) {

            $('#theDiv'+id_ongkir).fadeIn();
            	if($("#resi"+id_ongkir).val() == ""){
            		$('#centang'+id_ongkir).hide();
            	}
            	else{
            		$('#centang'+id_ongkir).show();
            	}
			$('#theDiv'+id_ongkir).fadeOut();

            },

            error : function() {

               

            }

        });
      

    return false;

    }

    function resivalid() 

   	{

   		if(confirm("Pastikan Resi Sudah Terisi di Transaksi ini, Jika Belum Mohon Klik Resi Belum Lengkap."))

   		{

        $.ajax( {

            type :"POST",

            url :"<?php echo site_url('ukm_info/resivalid'); ?>",

            cache :false,

            data: "id_trans=<?php echo $pembeli->ID_TRANS; ?>",

            success : function(msg) {

              alert("Berhasil menyimpan data.");

              window.location.href="<?php echo site_url('ukm_info/orderan'); ?>";

            },

            error : function() {

               

            }

        });

    	return false;

    	}

    }



	</script>	