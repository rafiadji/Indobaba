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
		.modal-dialog{
		    overflow-y: initial !important
		}
		.modal-body{
		    height: 550px;
		    overflow-y: auto;
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
	<div class="col-md-12"> 
	<div class="panel panel-primary">
	<div class="panel-heading">
	<h4 align="center">ORDERAN DITANGGAPI</h4>
	</div>
	</div>
	</div>

	<div class="col-md-7">
		<div class="panel panel-default" style="height:520px">
			<br/>
			<div style="border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<p style="text-align:justify"><b><i>Orderan Ditanggapi</i></b> adalah transaksi yang sudah diterima pembayarannya oleh indobaba. Silahkan lihat produk yang dibeli, ketersediaan barang, dan resi pengiriman untuk dikirim ke pembeli.</p>
			
			</div>
			<div class="panel-body">
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
					<td style="font-size:30px">
						<?php $ret = $this->db->query("SELECT * FROM mp_transaksi WHERE NO_TRANS='$pembeli->NO_TRANS'")->row(); ?>
						<p><?php echo formatRp($ret->TOT_TRANSFER); ?></p>
					</td>
					</tr>
					
					<tr>
					<td><b>Total Tagihan</b></td>
					<td>:</td>
					<td><p><?php echo formatRp(($ret->TOT_TRANSFER)-($ss->KODE_UNIK)); ?></p></td>
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
		$aslitot=0;
		foreach ($toko as $tok) {
		if($tok->STS_TAMPIL==0){
			$war = "background-color:red";
		}
		else
		{
			$war = "";
		}

		 ?>
		
			<?php
			if($tok->STS_TAMPIL==0){
				$war = "display:none;";
				?>
				<div class="panel panel-danger">
					<div class="panel-heading" style="background:red;color:white;">
					
							

							<h3 align="center"><?php echo $tok->NM_TOKO ?></h3>
							<hr>
							<?php 
							if($tok->STATUS_TERSEDIA==1)
							{ 
								?>
								<input type="hidden" name="id_toko[]" value="<?php echo $tok->ID_TOKO; ?>">
								<?php 
							} 
							?>

							<div class="form-group">
								<p align="center"><?php echo $tok->ALAMAT_TOKO ?> ( <?php echo $tok->NO_TELP_TOKO ?> )</p>
								
							</div>	
						
					</div>
				<div class="panel-body">
				<div class="col-md-12">
					<div style="text-align:justify;border-left: 5px solid red;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
					Orderan di toko ini telah dibatalkan karena ketersediaan barang tidak memenuhi permintaan pembeli, sejumlah uang yang telah dikirim untuk toko ini telah dimasukkan ke saldo akun pembeli.<br/><br/> Untuk lihat orderan apa saja yang dipesan di toko ini silahkan klik tombol dibawah ini 
					<?php 
					if($tok->STS_TAMPIL==0)
					{ 
						?>
						<br/><a href="#" onclick="detailBatal('<?php echo $id; ?>',<?php echo $tok->ID_TOKO; ?>)" class="btn btn-success btn-sm">Lihat Orderan Di Toko Ini</a>
						<?php 
					} 
					?>
				</div>
				</div>
				</div>
				<?php
			}
			else
			{
				$war = "";
				?>
				<div class="panel panel-default">
				<div class="panel-heading" style="background:orange;color:white;">
				
						

						<h3 align="center"><?php echo $tok->NM_TOKO ?></h3>
						<hr>
						<?php 
						if($tok->STATUS_TERSEDIA==1)
						{ 
							?>
							<input type="hidden" name="id_toko[]" value="<?php echo $tok->ID_TOKO; ?>">
							<?php 
						} 
						?>

						<div class="form-group">
							<p align="center"><?php echo $tok->ALAMAT_TOKO ?> ( <?php echo $tok->NO_TELP_TOKO ?> )</p>
							
						</div>	

					<?php if($tok->STS_RESI==1): ?>
					<?php $cekadatdak = $this->db->query("SELECT * FROM mp_kirim_rekening WHERE ID_TRANSAKSI='$pembeli->ID_TRANS' AND ID_TOKO='$tok->ID_TOKO'")->num_rows(); ?>
					<?php if($cekadatdak==0): ?>
					<a class="btn btn-primary" onclick="kirimrekening(<?php echo $tok->ID_TOKO; ?>,'<?php echo $id; ?>')">Kirim Ke Rekening <?php echo $tok->NM_TOKO ?></a>
					<?php else: ?>
					<a class="btn btn-success" onclick="kirimrekening(<?php echo $tok->ID_TOKO; ?>,'<?php echo $id; ?>')">Uang Sudah Terkirim Ke <?php echo $tok->NM_TOKO ?></a>
					<?php endif; ?>
					<?php endif; ?>

				</div>
				<?php
			}
			?>

			<div class="panel-body" style="<?php echo $war; ?>;background:rgba(96, 125, 139, 0.1)">
			
			<div class="col-md-8">
			</div>
			<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center>Bila Stok Hanya Tersedia Sebagian :</center> 
				</div>
				<div class="panel-body">
					<p style="font-size:20px;text-align:center">
						<?php
						if($tok->STATUS_TERSEDIA==1)
						{
							echo "<span style='color:green'>KIRIM YANG TERSEDIA</span>";
						}
						else if($tok->STATUS_TERSEDIA==0)
						{
							echo "<span style='color:red'>BATALKAN TRANSAKSI</span>";
						}
						?>
					</p>
				</div>
			</div>
			</div>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<?php
			$datanya = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO='$tok->ID_TOKO' GROUP BY ID_ALAMAT_PENERIMA")->result();
			$tot_harga=0;
			$tot_ongkir=0;
			$pj_tot=0;
			$web_tot=0;
			$ongkir=0;
			$ongkirbatal=0;
			$ku_web=0;
			$ku_pj=0;
			$tot_harga2=0;
			$tot_asli=0;
			?>
			
			
			
			<?php foreach($datanya as $deta)
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
			$ongkirsemuaasli=0;
			$ongkirsemuapalsu=0;
			$variable = $this->db->query("SELECT * FROM view_detail_transaksi GROUP BY ID_ONGKIR")->result();
			
			foreach ($variable as $key ) 
			{
			$haha = $this->db->query("SELECT COUNT(*) AS A FROM view_detail_transaksi WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->row();
			if($haha->A>0)
			{
				$ongkirsemuaasli+=$key->HARGA_ONGKIR;
	    		$ongkirsemuapalsu+=$key->TOTAL_ONGKIR_REALISASI;

				$lala=$this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_ONGKIR='$key->ID_ONGKIR' AND ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->result();
			?>
				<table id="example1" class="table table-bordered table-striped">
			        <thead>
			        	<tr style="background:#d9ffac;">
							<th style="text-align:center">No</th>
							<th style="text-align:center">Produk</th>
							<th style="text-align:center">Jumlah Dipesan</th>
							<th style="text-align:center">Berat Satuan</th>
							<th style="text-align:center">Total Berat</th>
							<th style="text-align:center">Harga Satuan</th>
							<?php if($tok->STATUS_TERSEDIA==1){ ?>
							<th style="text-align:center">Stok Tersedia</th>
							<?php } ?>
							<th style="text-align:center">Total Harga Dipesan</th>
							<th style="text-align:center">Potongan Indobaba (5%)</th>
							<th style="text-align:center">Potongan PJ (5%)</th>
						</tr>
			        </thead>
			       	<tbody>
			    	<?php 
			    	$no = 1;
			    	$tot_web=0;
			    	$tot_pj=0;
			    	$tot_akh=0;
			    	$tot_akh_ongkir=0;
			    	$tot_akh2=0;
			    	$totalasli=0;
			    	foreach($lala as $detail){ ?>
			    	<tr align="center">
			    		<td><?php echo $no++; ?></td>
						<td><?php echo $detail->NM_PRODUK; ?></td>
						<td><?php echo $detail->QTY; ?> buah</td>
						<td><?php echo konversiGram($detail->BERAT_PRODUK); ?></td>
						<td><?php echo konversiGram($detail->BERAT_PRODUK*$detail->QTY_TERSEDIA); ?></td>
						<td><?php echo formatRp($detail->HARGA_PER); ?></td>
						<?php if($tok->STATUS_TERSEDIA==1){ 
							$tp = "text";
							$dp = "";
						}
						else
						{
							$tp = "hidden";
							$dp ="style='display:none;'";
						}?>
						<td <?php echo $dp; ?>>
						<?php 
						if($key->STS_TANGGAP==1)
						{
							$read = "readonly=''";
						}
						else
						{
							$read = "";
						}
						?>
							<input type="<?php echo $tp; ?>" value="<?php echo $detail->QTY_TERSEDIA; ?>" id="qtytersedia[]" class="qtysedia<?php echo $detail->ID_CART; ?> nuaa" onkeyup="qtysedia(<?php echo $detail->QTY; ?>,<?php echo $detail->ID_CART; ?>)"  name="qtytersedia<?php echo $tok->ID_TOKO ?>[]" <?php echo $read; ?> required/>	
						</td>
						<?php
						 $totharga2 = $detail->HARGA_PER*$detail->QTY_TERSEDIA; 
						?>
						<td><?php 
						$tot_akh2 += $totharga2;
						echo formatRp($totharga2); 
						?></td>
						<td>
						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
							  $keuntungan1 =($detail->KEUNTUNGAN_INDOBABA/100)*$totharga2;
							  $tot_web+=$keuntungan1;
							 	echo formatRp($keuntungan1);
						?>
						</td>
						<td>
						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
							  $keuntungan2 =($detail->KEUNTUNGAN_PJ/100)*$totharga2;
							  $tot_pj+=$keuntungan2;
							  echo formatRp($keuntungan2);
						?>
						</td>
						<?php  $asli = $detail->HARGA_PER*$detail->QTY;  $totalasli+=$asli;  //echo $asli; ?>
						
						<input type="hidden" value="<?php echo $detail->ID_CART; ?>" id="cart" class="cart[]" name="cart<?php echo $tok->ID_TOKO ?>[]" required/>
					<tr>
			    	<?php } ?>
			       	</tbody>
				       <tfoot>
				       	<tr align="center">
				       		<?php if($tok->STATUS_TERSEDIA==1){ ?>
				       		<td colspan="7">Jumlah</td>
				       		<?php }
				       		else{ ?>
				       		<td colspan="6">Jumlah</td>
				       		<?php } ?>
				       		<td><?php $tot_harga2+=$tot_akh2; echo formatRp($tot_akh2);?></td>
				       		<td><?php $ku_web += $tot_web; echo formatRp($tot_web); ?></td>
				       		<td><?php $ku_pj += $tot_pj; echo formatRp($tot_pj);  ?></td>
				       		<?php $tot_asli += $totalasli; //echo $totalasli;  ?>
				       		
				       		
				       	</tr>
				       	<tr style="background:#d9ffac;">
				       		<?php if($tok->STATUS_TERSEDIA==1){ ?>
				       		<td colspan="10" style="color:black;font-size:12pt">
				       		<?php }
				       		else{ ?>
				       		<td colspan="9" style="color:black;font-size:12pt">
				       		<?php } ?>
				       		<b>
				       		Produk diatas dikirim dengan kurir <?php echo strtoupper($key->NAMA_KURIR)." - ".$key->PAKET_YANG_DIAMBIL; ?>
		    				<?php if($tok->STATUS_TERSEDIA==1)
							{ ?>
		    				<input type="hidden" name="ongkir[]" value="<?php echo $key->ID_ONGKIR; ?>">
		    				<?php } ?><?php 
		    				$ongkir+=$key->TOTAL_ONGKIR_REALISASI; 
		    				$ongkirbatal+=$key->HARGA_ONGKIR; 
		    				?>
				       		<?php
		    				echo "(".formatRp($key->TOTAL_ONGKIR_REALISASI).")";
		    				 ?>
		    				 </b>

							    
		    				 </td>
				       	</tr>
				       	<tr>
				       		<?php if($tok->STATUS_TERSEDIA==1){ ?>
				       		<td colspan="10" style="color:black;font-size:12pt" align="right">
				       		<?php }
				       		else{ ?>
				       		<td colspan="9" style="color:black;font-size:12pt" align="right">
				       		<?php } ?>
				       		<?php if($key->STS_TANGGAP==1)
		    				 	{ 
		    				 		if($key->STS_TAMPIL==1){
								?>
							        <div class="form-group" align="left">
									
									<?php $q=$this->db->query("SELECT * FROM mp_cart WHERE ID_TRANS='$pembeli->ID_TRANS' AND ID_ONGKIR='$key->ID_ONGKIR'")->row(); ?>
								 	<b>Masukan Resi </b><input type="text" style="width:300px" value="<?php if($q) echo $q->RESI; ?>" required  id='resi<?php  echo $key->ID_ONGKIR ?>' class="resi[]"> 
								 	<a href="#" class="btn btn-primary" onclick="resi(<?php echo $key->ID_ONGKIR; ?>,<?php echo $tok->ID_TOKO; ?>)">Kirim Resi</a>
								 	<?php if($key->STATUS_TERSEDIA==1){ ?>
								 	<a href="#" class="btn btn-warning" onclick="batalkanini(<?php echo $tok->ID_TOKO; ?>,<?php echo $key->ID_ONGKIR; ?>)">Kembali ubah stok yang tersedia</a>
									<?php } ?>
									</div>

								<?php 
									}
								}
								else
								{
									 if($tok->STATUS_TERSEDIA==1)
									 { ?>
									
								        <a href="#" align="center" onclick="aaaa(<?php echo $tok->ID_TOKO; ?>,<?php echo $key->ID_ONGKIR; ?>)" class="btn btn-success">Konfrimasi</a>
								      
							         <?php 
							     	}
								} ?>
							    
				       	</td>
				       	</tr>
				       </tfoot>
		        </table>
				</table>
				<br>
				
		         <?php
		     }
		}
		$okr = $ongkirsemuaasli-$ongkirsemuapalsu;
		?>
		        
		<?php 
				 if($tok->STATUS_TERSEDIA==0)
				{
					if($tok->STS_TANGGAP==0)
					{
					?>
			     	<a href="#" onclick="ccc(<?php echo $tok->ID_TOKO;  ?>)" class="btn btn-success">Kirim Barang</a>
					<a href="#" onclick="bbb(<?php echo $tok->ID_TOKO; ?>,<?php echo $key->ID_ONGKIR; ?>)" class="btn btn-danger">Batalkan Transaksi</a>
					<?php
					}
					else
					{
						?>
						<a href="#" class="btn btn-danger" onclick="batalkirimbarang(<?php echo $tok->ID_TOKO; ?>)" >Batal</a>
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
		        				$tg+=$tot_harga2+$ongkir;
		        				echo formatRp($tot_harga2+$ongkir); ?></td>
					</tr>

					<?php $ind = $this->db->query("SELECT * FROM mp_riwayat_untung WHERE ID_TOKO='$tok->ID_TOKO' AND ID_TRANS='$pembeli->ID_TRANS'")->row(); ?>
					<?php if($ind): ?>
					<tr>
					<td><b>Keuntungan Indobaba</b></td>
					<td style="padding:8px">:</td>
					<td style="font-size:20px"><?php echo $ind->NOMINAL_INDOBABA; ?></td>
					</tr>

					<tr>
					<td><b>Keuntungan PJ</b></td>
					<td style="padding:8px">:</td>
					<td style="font-size:20px"><?php echo $ind->NOMINAL_PJ;  ?></td>
					</tr>
					<?php endif; ?>

				</table>
			</div>

			<div style="float:right; width:40%">
				<table align="center">
					<tr>
					<td><b>Total Yang dibayar ke <?php echo $tok->NM_TOKO ?></b></td>
					<td style="padding:8px">:</td>
					<td style="font-size:25px"><?php echo formatRp(($tot_harga2+$ongkir)-($ku_web+$ku_pj)); ?></td>
					</tr>
				</table>
				<div style="text-align:justify;border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
					Nominal diatas adalah jumlah yang harus dibayar ke <b><i><?php echo $tok->NM_TOKO ?></i></b> dari transaksi ini, 
					berdasarkan total tagihan dikurangkan dengan potongan indobaba (5%) dan potongan PJ (5%) lalu dijumlah dengan ongkos
					kirim
				</div>
			</div>

			<?php 
		    $aslitot+=$tot_asli+$ongkir+$okr;
		    ?>
		        	<!--
		        	<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        			 	Sisa Nominal Pembeli
		        			</div>
		        			<div class="panel-body">
		        				<h2></h2>
		        			</div>
		        		</div>
		        	</div>-->
		       
		        
			</div>
		</div>
		<br/>
		<hr/>
		<br/>
			<?php
		}
		 ?>
		  <div class="row">
        	<div class="col-md-6">
        		<div class="panel panel-info">
        			<div class="panel-heading">
        				<center>Dana Pembeli Dari Transaksi Ini</center>
        			</div>
        			<div class="panel-body">
        				<h2 align="center"><?php echo formatRp($tg); ?></h2>
        			</div>
        		</div>
        	</div>
        	<div class="col-md-6">
        		<div class="panel panel-info">
        			<div class="panel-heading">
        				<center>Masuk Ke Saldo Pembeli Dari Transaksi Ini</center>
        			</div>
        			<div class="panel-body">
        				<h2 align="center"><?php 
        				$saldo=$aslitot-$tg;
        				echo formatRp($saldo);
        				?></h2>
        			</div>
        		</div>
        	</div>
		  </div>
		  <div class="row">
		        	<div class="col-md-6">
		        			
		        			<a href="<?php echo site_url('admin_transaksi/tabel/2'); ?>" class="btn btn-danger">Kembali</a>
		        	</div>
		  </div>	
	</div>
	</form>
	<script>
	function kirimemail(trans,toko)
	{
		 $.ajax( {
              type :"POST",
              url :"<?php echo base_url(); ?>admin_transaksi/kirimemail",
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
	$("#cok").submit( function() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/do_tersedia'); ?>",
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
            url :"<?php echo site_url('admin_transaksi/do_tersedia'); ?>",
            cache :false,
            data: $( "#cok" ).serialize()+"&tokonya="+idtoko+"&ongkirs="+idongkir,
            success : function(msg) {
              $(".loader").fadeOut();
              alert("Berhasil menyimpan data.");
              window.location.reload();
            },
            error : function() {
               
            }
        });
    return false;
    }
    function bbb(idtoko,idongkir) 
   {
	   	if(confirm("Apakah yakin membatalkan?"))
	   	{
	        $(".loader").fadeIn();
	        $.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('admin_transaksi/do_batal'); ?>",
	            cache :false,
	            data: "&tokonya="+idtoko+"&"+$( "#cok" ).serialize()+"&ongkirs="+idongkir,
	            success : function(msg) {
	              $(".loader").fadeOut();
	              alert("Berhasil menghapus data.");
	              window.location.reload();
	            },
	            error : function() {
	               
	            }
	        });
	    	return false;
		}
    }     
    function batalkirimbarang(idtoko) 
   {
	        $(".loader").fadeIn();
	        $.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('admin_transaksi/batalkirimbarang'); ?>",
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
    function ccc(idtoko) 
   {
	        $(".loader").fadeIn();
	        $.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('admin_transaksi/do_kirimkan'); ?>",
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
    function ubahstatus() 
   {
   	if(confirm("Pastikan Jumlah Barang Sudah Valid , Karena Sistem Otomatis Update Saldo. Jika Belum Valid Tekan Cancel."))
   	{
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/ubahstatus'); ?>",
            cache :false,
            data: "no_trans="+<?php echo $pembeli->NO_TRANS; ?>+"&id_trans="+$("#id_trans").val()+"&saldo="+<?php echo $saldo; ?>+"&pembeli="+<?php echo $pembeli->ID_AKUN; ?>,
            success : function(msg) {
              alert("Berhasil menyimpan data.");
              window.location.href="<?php echo site_url('admin_transaksi/tabel/2'); ?>";
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
	function resi(id_ongkir,toko) 
   	{
		$(".loader").fadeIn();
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/isiresi'); ?>",
            cache :false,
            data: "no_trans="+<?php echo $pembeli->NO_TRANS; ?>+"&id_ongkir="+id_ongkir+"&id_trans=<?php echo $pembeli->ID_TRANS; ?>&resi="+$("#resi"+id_ongkir).val()+"&toko="+toko,
            success : function(msg) {
            $(".loader").fadeOut();
              alert("Berhasil menyimpan data.");
              window.location.reload();
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
            url :"<?php echo site_url('admin_transaksi/batalkanini'); ?>",
            cache :false,
            data: $( "#cok" ).serialize()+"&tokonya="+idtoko+"&ongkirs="+idongkir,
            success : function(msg) {
              $(".loader").fadeOut();
              alert("Berhasil menyimpan data.");
              window.location.reload();
            },
            error : function() {
               
            }
        });
    return false;
    } 

    function detailBatal(id_trans,id_toko) {
    $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/detailBatal'); ?>",
            cache :false,
            data:"id_trans="+id_trans+"&id_toko="+id_toko,
            success : function(msg) {
              $(msg).modal();
            },
            error : function() {
               alert("Error");
            }
        });
    return false;
	}
	function kirimrekening(id_toko,id_trans) {
    $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/kirimRekening'); ?>",
            cache :false,
            data:"id_toko="+id_toko+"&id_trans="+id_trans,
            success : function(msg) {
              $(msg).modal();
            },
            error : function() {
               alert("Error");
            }
        });
    return false;
	}
	</script>