<?php $link = site_url('assets/images/page-loader.gif'); ?>
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
	<form id="testForm" method="POST">
	<input type="hidden" name="no_trans" value="<?php echo $pembeli->NO_TRANS; ?> "><!-- Ini UNTUK nO Trans -->
	<div class="col-md-12"> 
		<div class="panel panel-info">
			<div class="panel-heading">
				<h4 align="center">ORDERAN BARU</h4>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="panel panel-default" style="height:677px">
			<br/>
			<div style="border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<p style="text-align:justify"><b><i>Orderan baru</i></b> adalah transaksi yang baru di lakukan oleh pembeli namun belum di konfirmasi pembayarannnya oleh admin. Silahkan klik tombol <span style="color:green">"Konfirmasi" </span>  berwarna hijau di panel "Bukti Transfer" bila pembayaran di transaksi ini sudah diterima oleh indobaba, apabila pembayaran belum diterima silahkan klik tombol <span style="color:red">"Tidak Valid"</span> berwarna merah maka transaksi akan dikembalikan kepada pembeli</p>
			
			</div>
			
			
			<div class="panel-body" >
				<h4><i>Informasi Akun Pembeli</i></h4>
				<hr/>
				<table class="table table-striped">
					<tr>
					<td><b>Tanggal Transaksi</b></td>
					<td>:</td>
					<td><b><i><?php echo tgl_indo_lengkap($pembeli->TGL_TRANS); ?></i></b></td>
					</tr>
					
					<tr>
					<td><b>Nama Pembeli</b></td>
					<td>:</td>
					<td><?php echo $pembeli->NAMA; ?></td>
					</tr>
					<tr>
					<td><b>Alamat</b></td>
					<td>:</td>
					<td><?php echo $pembeli->ALAMAT; ?></td>
					</tr>
					<tr>
					<td><b>No HP</b></td>
					<td>:</td>
					<td><?php echo $pembeli->NO_HP; ?></td>
					</tr>
				</table>
			
			</div>
		</div>
	</div>
	<?php  $ss = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$pembeli->NO_TRANS'")->row(); 
	if($ss)
	{
	?>	
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-heading">
					<h4 align="center"><i>Bukti Transfer</i></h4>
			</div>
			<div class="panel-body">
			
				<table class="table table-striped">
					
					
					<tr>
					<td><b>ID Transaksi</b></td>
					<td>:</td>
					<td><?php echo $id; ?></td>
					</tr>
					<tr>
					<td><b>Total Transfer</b></td>
					<td>:</td>
					<td style="font-size:30px"><span id="nominalnya"></span></td>
					</tr>
					
					<tr>
					<td><b>Total Tagihan</b></td>
					<td>:</td>
					<td><span id="tghn"></span></td>
					</tr>
					
					<tr>
					<td><b>Kode Unik</b></td>
					<td>:</td>
					<td><?php echo $ss->KODE_UNIK; ?></td>
					</tr>

				</table>
				<hr>
				<table class="table table-striped">	

					<tr>
					<td><b>Tanggal Transfer</b></td>
					<td>:</td>
					<td><?php echo $ss->TGL_TRANSFER; ?></td>
					</tr>
					<tr>
					<td><b>No Rekening Pengirim</b></td>
					<td>:</td>
					<td><?php echo $ss->NO_REKENING; ?></td>
					</tr>
					<tr>
					<td><b>Atas Nama Pengirim</b></td>
					<td>:</td>
					<td><?php echo $ss->ATAS_NAMA; ?></td>
					</tr>
					<tr>
					<td><b>Nama Bank Tujuan</b></td>
					<td>:</td>
					<td><?php 
					$qii = $this->db->query("SELECT * FROM mp_rekening WHERE ID_REKENING='$ss->BANK_TUJUAN'")->row();
					$qi = $this->db->query("SELECT * FROM mp_bank WHERE ID_BANK='$qii->ID_BANK'")->row();
					 ?>
					<p><?php if($qi) echo $qi->BANK; ?></p></td>
					</tr>
					
					<tr>
					<td><b>Foto Bukti</b></td>
					<td>:</td>
					<td><a href="#" data-toggle="modal" data-target="#buktiModal">Lihat Foto Bukti</a></td>
					</tr>
				</table>
				
			
				<?php include('bukti_modal.php'); ?>
				<div class="form-group">
					<a href="#" onclick="do_menunggu_konfirmasi_admin(<?php echo $pembeli->NO_TRANS; ?>,'<?php echo $id; ?>')" class="btn btn-success">Konfirmasi</a>
					<a href="#" onclick="do_konfirmasi_ulang(<?php echo $pembeli->NO_TRANS; ?>)" class="btn btn-danger">Tidak Valid</a>
				</div>
				<div style="text-align:justify;border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
				Note : Bila pembayaran sudah diterima silahkan klik tombol konfirmasi maka transaksi akan dikirim ke halaman penjual untuk dilihat, dikonfirmasi ketersediaan barang, dan dilakukan pengiriman
				</div>
			</div>
		</div>
	</div>
	<?php }
	else 
	{?>
		<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>Bukti Transfer</h4>
				<hr/>
				<div class="form-group">
					Bukti Transfer Belum Ada
				</div>
			</div>
		</div>
	</div>
	<?php }
		?>
	<div class="col-md-12">
		
	<?php 
	$pjs=0;
	$tg=0;

	foreach ($toko as $tok) 
	{ 
	?>


				<div class="panel panel-default">
					<div class="panel-heading" style="background:orange;color:white">
					<h3><?php echo $tok->NM_TOKO ?></h3>
						<div class="form-group">
							<p><?php echo $tok->ALAMAT_TOKO ?> ( <?php echo $tok->NO_TELP_TOKO ?> )</p>
						</div>
						<?php
						if($pembeli->ID_STATUS==2)
						{
						?>
						<div class="form-group">
							<label>Masukan Resi : </label>
							 <input type="text" class="form-control" required name="resi[]" class="resi[]">
							 <input type="hidden" class="form-control" name="toko[]" value="<?php echo $tok->ID_TOKO; ?>"> <!-- Ini UNTUK TOKO -->
						</div>
						<?php 
						} 
						?>
					</div>
					<div class="panel-body" style="background:rgba(96, 125, 139, 0.1)">
					
					
					
					<?php
					$datanya = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO='$tok->ID_TOKO' GROUP BY ID_ALAMAT_PENERIMA")->result();
					$tot_harga=0;
					$tot_ongkir=0;
					$pj_tot=0;
					$ongkir=0;
					$ku_web=0;
					$ku_pj=0;
					foreach($datanya as $deta)
					{	
					?>
					<div class="panel panel-default">
					<div class="panel-heading" style="background-color:white">
							<h4>Tujuan Pengiriman</h4>
							<table class="table table-striped">
								<tr>
								<td>Nama Penerima</td>
								<td>:</td>
								<td><?php echo $deta->NAMA_PENERIMA; ?></td>
								</tr>
								<tr>
								<td>Telp Penerima</td>
								<td>:</td>
								<td><?php echo $deta->NO_HP_PENERIMA; ?></td>
								</tr>
								<tr>
								<td>Alamat</td>
								<td>:</td>
								<td> <?php echo $deta->ALAMAT_PENERIMA; ?></td>
								</tr>
								<tr>
								<td>Kode Pos</td>
								<td>:</td>
								<td> <?php echo $deta->KODE_POS; ?></td>
								</tr>
								<tr>
								<td>Kota</td>
								<td>:</td>
								<td><?php echo getKabupatenRj($deta->PROVINSI,$deta->KOTA_KAB); ?></td>
								</tr>
								<tr>
								<td>Provinsi</td>
								<td>:</td>
								<td><?php echo getProvinsiRj($deta->PROVINSI); ?></td>
								</tr>
								
							</table>
					</div>
					<div class="panel-body">
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
							        <thead style="background:#d9ffac;">
							        	<tr>
											<th style="text-align:center">No</th>
											<th style="text-align:center">Produk</th>
											<th style="text-align:center">QTY</th>
											<th style="text-align:center">Berat @</th>
											<th style="text-align:center">Harga @</th>
											<th style="text-align:center">Total Berat</th>
											<th style="text-align:center">Total Harga</th>
											<th style="text-align:center">Potongan INDOBABA (5%)</th>
											<th style="text-align:center">Potongan PJ (5%)</th>
										</tr>
							        </thead>

							       	<tbody>
								    	<?php 
								    	$no = 1;
								    	$tot_web=0;
								    	$web_tot=0;
								    	$tot_pj=0;
								    	$tot_akh=0;
								    	$tot_akh_ongkir=0;
								    	//$lala = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->result();
								    	foreach($lala as $detail){ ?>
								    	<tr align="center">
								    		<td><?php echo $no++; ?></td>
											<td><?php echo $detail->NM_PRODUK; ?></td>
											<td><?php echo $detail->QTY; ?> buah</td>
											<td><?php echo $detail->BERAT_PRODUK; ?> g</td>
											<td><?php echo formatRp($detail->HARGA_PER); ?></td>
											<td><?php echo konversiGram($detail->BERAT_PRODUK*$detail->QTY); ?></td>
											<?php $totharga = $detail->HARGA_PER*$detail->QTY; $tot_harga+=$totharga; ?>
											<td><?php $tot_akh += $totharga; echo formatRp($totharga); ?></td>
											<td>
											<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
												  $keuntungan1 =($detail->KEUNTUNGAN_INDOBABA/100)*$totharga;
												  $web_tot+=$keuntungan1;
												  echo formatRp($keuntungan1);
											?></td>
											<td>
											<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
												  $keuntungan2 =($detail->KEUNTUNGAN_PJ/100)*$totharga;
												  $tot_pj+=$keuntungan2;
												  echo formatRp($keuntungan2);
											?></td>
										<tr>
								    	<?php } ?>
							       	</tbody>

							       <tfoot>
							       	<tr  align="center">
							       		<td colspan="6">Jumlah</td>
							       		<td><?php echo formatRp($tot_akh); ?></td>
							       		<td><?php $ku_web += $web_tot; echo formatRp($web_tot); ?></td>
							       		<td><?php $ku_pj += $tot_pj; echo formatRp($tot_pj); ?></td>
							       		
							       	</tr>
							       	<tr style="background:#d9ffac">
							       		<td colspan="9">
							       			<b>Produk diatas dikirim dengan kurir <?php echo "<b>".strtoupper($key->NAMA_KURIR)." - ".$key->PAKET_YANG_DIAMBIL."</b>"; ?>
							       			<?php $ongkir+=$key->TOTAL; echo formatRp($key->TOTAL); ?></b>
							       		</td>
							       	</tr>
							       </tfoot>
						        </table>

								<hr/>
								<?php 
								}
							}


					?>
					</div>
					</div>
					
					<hr/>
					
					<?php
					}
	?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><center>Ringkasan Transaksi Dari <b><?php echo $tok->NM_TOKO ?></b></center></h4>
				</div>
			</div>
			<div style="float:left;width:50%">
				<table>
					<tr>
					<td><b>Total ongkos kirim dari toko ini</b></td>
					<td style="padding:8px">:</td>
					<td style="font-size:20px"><?php echo formatRp($ongkir); ?></td>
					</tr>
					<tr>
					<td><b>Tagihan ke pembeli dari toko ini</b></td>
					<td style="padding:8px">:</td>
					<td style="font-size:20px"><?php  
			        				$tg +=$tot_harga+$ongkir;
			        				echo formatRp($tot_harga+$ongkir); ?></td>
					</tr>

				</table>
			</div>
			<div style="float:right; width:40%">
				<table align="center">
					<tr>
					<td><b>Total Yang dibayar ke <?php echo $tok->NM_TOKO ?></b></td>
					<td style="padding:8px">:</td>
					<td style="font-size:25px"><?php echo formatRp(($tot_harga+$ongkir)-($ku_web+$ku_pj)); ?></td>
					</tr>
				</table>
				<div style="text-align:justify;border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
					Nominal diatas adalah jumlah yang harus dibayar ke <b><i><?php echo $tok->NM_TOKO ?></i></b> dari transaksi ini, 
					berdasarkan total tagihan dikurangkan dengan potongan indobaba (5%) dan potongan PJ (5%) lalu dijumlah dengan ongkos
					kirim
				</div>
			</div>	        
		        
			</div>
		</div>
		<br/>
		<hr/>
		<br/>
		<?php
		}

		?>
		
		  <!-- <div class="row">
		        	<div class="col-md-6">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Total Tagihan ke pembeli
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php echo formatRp($tg); ?></h2>
		        			</div>
		        		</div>
		        	</div>
		  </div>	 -->
	</div>
	</form>
	<script>
	function kirimemail(trans,toko)
	{
		 $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/kirimemail') ?>",
              cache :false,
              data: "trans=" + trans + "&toko="+toko,
              success : function(msg) {
                  alert("Berhasil Mengirim Email");
                  location.reload(); 
                  //$("#data_s3").html(msg);
              },
              error : function() {
                  //$('#data_s3').replaceWith('Error');
              }
          });
	}

	function do_menunggu_konfirmasi_admin(no_trans,id_trans)
	{
		$(".loader").fadeIn();
		 $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/do_menunggu_konfirmasi_admin') ?>",
              cache :false,
              data: "no_trans=" + no_trans+"&id_trans=" + id_trans ,
              success : function(msg) {
              	  $(".loader").fadeOut();
              	  alert(msg);
              	  window.location.href="<?php echo site_url('admin_transaksi/tabel/1'); ?>";
              },
              error : function() {
                  //$('#data_s3').replaceWith('Error');
              }
          });
	}
	function do_konfirmasi_ulang(no_trans)
	{
		 $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/do_konfirmasi_ulang') ?>",
              cache :false,
              data: "no_trans=" + no_trans ,
              success : function(msg) {
                  alert(msg);
                   window.location.href="<?php echo site_url('admin_transaksi/tabel/1'); ?>";
              },
              error : function() {
                  //$('#data_s3').replaceWith('Error');
              }
          });
	}
	hituung();
	tghn();
	function hituung()
	{
		 $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/hituung') ?>",
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
              url :"<?php echo site_url('admin_transaksi/tghn') ?>",
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
	$(window).load(function() {
    $(".loader").fadeOut(500);
})
	</script>