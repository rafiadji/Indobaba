<div class="container">
<div class="row">
    		<div class="col-md-12">
    			<div class="desk-produk">
	    			<h4>Keranjang Belanja</h4>
	    			<br/>
	    			Pastikan barang belanjaan anda. Jika anda sudah yakin, silahkan klik tombol <strong>"checkout"</strong>
    			</div>
    		</div>
    	</div>
	<div class="row">
		<div class="col-md-9">
		
			<?php if ($toko) :?>
	<?php 
	$k = 0;
	foreach ($toko as $tk) : 
	$m = 0;
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<table width="100%">
				<tr>
				<td width="40%"><h3 style="color: #F27A24"><?php echo $tk->NM_TOKO; ?></h3></td>
				
				<td style="font-size:12px">Apabila stok yang tersedia hanya sebagian:</td>
				<td> <select class="form-control col-md-5"   name="status_ketersediaan<?php echo $k; ?>" id="sts_sedia<?=$k?>" onchange="upt_sts(<?php echo $tk->ID_TOKO; ?>, <?php echo $akun; ?>, this.value)">
					<!-- <option value="0">Batalkan keseluruhan pesanan</option>
					<option value="1">Kirimkan stok yang tersedia</option> -->
				</select>
				</td>
				</tr>
				</table>
			</div>
			
			<div class="panel-body panel-cart-puji">
					
				<?php 
					$alamat = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' GROUP BY ID_ALAMAT")->result();
					foreach ($alamat as $al) : ?>
					<div class="row">
							<div class="col-md-12">
								<table width="100%" class="table">
									<tr>
										<th>Alamat Tujuan</th>
										<td>:</td>
										<td><?php echo $al->ALAMAT; ?></td>
									</tr>
									<tr>
										<th>Nama Penerima</th>
										<td>:</td>
										<td><?php echo $al->NAMA_PENERIMA; ?></td>
									</tr>
									<tr>
										<th>Telp Penerima</th>
										<td>:</td>
										<td><?php echo $al->NO_HP_PENERIMA; ?></td>
									</tr>
									<tr>
										<th>Kode Pos</th>
										<td>:</td>
										<td><?php echo $al->KODE_POS; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<?php 
							$kurir = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' GROUP BY ID_ONGKIR")->result();
							foreach ($kurir as $kr) : ?>
							<table class="table table-striped table-bordered">
							<tr class="info">
								<th>Nama Produk</th>
								<th>Qty</th>
								<th>Berat@</th>
								<th>Total Berat</th>
								<th>Harga@</th>
								<th>Total Harga</th>
								<!-- <td>Ongkir</td> -->
								<th>Aksi</th>
							</tr>
							<?php 
							$i = 0;
							$pro = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND ID_ONGKIR = '$kr->ID_ONGKIR'")->result();
							foreach ($pro as $pr) : ?>
								<tr>
									<td><a href="<?=base_url()?>Home_controller/detailProduct/<?php echo $pr->ID_PRODUK; ?>"><?php echo $pr->NM_PRODUK; ?></a></td>
									<td><?php echo $pr->QTY; ?></td>
									<td><?php echo konversiGram($pr->BERAT_PRODUK); ?></td>
									<td><?php echo konversiGram($pr->QTY * $pr->BERAT_PRODUK); ?></td>
									<td><?php echo formatRp($pr->HARGA_SATUAN); ?></td>
									<td><?php echo formatRp($pr->QTY * $pr->HARGA_SATUAN); ?></td>
									<!-- <td><?php // echo formatRp($pr->TOTAL).'<br/>('.strtoupper($pr->NAMA_KURIR).', '.$pr->PAKET_YANG_DIAMBIL.')'; ?></td> -->
									<td><?php echo anchor("user_checkout/hapusProdukcart/".$pr->ID_CART,"<i class='fa fa-trash'></i> Hapus",array('class' => 'hapus-puji','onClick' => "return confirm('Hapus Produk $pr->NM_PRODUK ?')"))?></td>
									<?php $pro_harga[$i] = ($pr->QTY * $pr->HARGA_SATUAN); 
										$pro_berat[$i] = ($pr->QTY * $pr->BERAT_PRODUK);?>
								</tr>
							<?php $i++; endforeach; ?>
							<?php 
							for ($f=0; $f < $i; $f++) {
								$pro_berat[$f] += @$pro_berat[$f-1];
							}?>
							<tr>
								<?php 
								$cost = $this->rajaongkir->cost($tk->ID_KOTA,$al->KOTA_KAB,$pro_berat[$f-1],$kr->NAMA_KURIR);
								$cost=json_decode($cost);
								$no=0;
								foreach ($cost->rajaongkir->results as $a) {
									foreach ($a->costs as $cc) {
										// print_r($cc);
										if($cc->service == $kr->PAKET_YANG_DIAMBIL)
										{
											foreach ($cc->cost as $o) {
												$estimasi = $o->etd;
											}
											
										}
									}
								}?>
								<td colspan="3">Ekspedisi : <?php echo strtoupper($kr->NAMA_KURIR); ?> ( <?php echo $kr->PAKET_YANG_DIAMBIL ?> ) / <?php echo formatRp($kr->TOTAL) ?></td>
								<td><?php echo konversiGram($pro_berat[$f-1]); ?></td>
								<td colspan="3">Estimasi : <?=$estimasi?> hari </td>
							</tr>
							</table>
							<?php 
							for ($n=0; $n < $i; $n++) {
								$pro_harga[$n] += @$pro_harga[$n-1];
							}
							$tot_harga[$m] = $pro_harga[$n-1] + $kr->TOTAL;
							?>
						<?php $m++; endforeach; ?>
						
					<?php endforeach; ?>
					<!-- SEK -->
					<?php for ($j=0; $j < $m; $j++) : ?>
						<?php $tot_harga[$j] += @$tot_harga[$j-1]; ?>
					<?php endfor; 
					$tot_tag[$k] = @$tot_harga[$j-1];?>
			</div>
		</div>
	<?php $k++; endforeach; ?>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default inherit">
				<div class="panel-heading">
				<h4 style="color: #F27A24" align="center"><strong>RINGKASAN TRANSAKSI</strong></h4>
				</div>
				<div class="panel-body" >
				<p>ID : <?=$tk->ID_TRANS?></p>
				<hr>
				<table class="table-puji">
				<?php $s=0; foreach($toko as $tko):?>
				<tr> 
					<td><p><?=$tko->NM_TOKO?></p></td> 
					<td><p>&nbsp;:&nbsp;</p></td> 
					<td><p><?=formatRp($tot_tag[$s]); ?></p></td> 
				</tr>
				<?php $s++; endforeach; ?> 
				</table>
				<?php for ($l=0; $l < $k; $l++) : ?>
					<?php $tot_tag[$l] += @$tot_tag[$l-1]; ?>
				<?php endfor; ?>
				<br>
				<table class="table-puji">
				 <tr> 
					 <td><p>Total tagihan</p></td>
					 <td><p>&nbsp;:&nbsp;</p></td>
					 <td><p><?php echo formatRp($tot_tag[$l-1]); ?></p></td>
				 </tr> 
				 <tr> 
					 <td><p>Kode Unik</p></td>
					 <td><p>&nbsp;:&nbsp;</p></td>
					 <td><p><?php
								// $kode_unik = kodeUnik($tk->ID_TRANS);
								// echo $kode_unik;
								echo $this->session->userdata("kode_unik");
							?>
					</p></td>
				 </tr>
				</table>
				<br>
				<p>Total Bayar :</p>
				<p style="font-size:35px; color:#F27A24;"><?php echo formatRp($tot_tag[$l-1] + $this->session->userdata("kode_unik")); ?></p>

				<?= anchor("user_checkout/checkout_cart","Checkout",array('class' => 'btn btn-success'))?>
				</div>
			</div>
		</div>
<?php else : ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-lg">
				Keranjang belanja Anda masih kosong, silahkan pilih salah satu produk UKM kami <a href="<?php echo base_url() ?>">disini</a>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
	</div>
</div>
<script type="text/javascript">
	var jumlah_tk = <?=$k?>;
	$(document).ready(function(){
		$.ajax({
			dataType:"json",
			type:"POST",
			url:"<?=site_url('user_checkout/sts_tersedia');?>",
			data:"id_akun="+<?php echo $akun; ?>,
			success:function(html){
				for (var i=0; i < html.status.length; i++) {
					if (html.status[i] == 1){
						var str = '<option value="1" selected>Kirimkan stok yang tersedia</option>'+
								'<option value="0">Batalkan keseluruhan pesanan</option>'
					}
					else{
						var str = '<option value="1">Kirimkan stok yang tersedia</option>'+
								'<option value="0" selected>Batalkan keseluruhan pesanan</option>'
					}
					$('#sts_sedia'+i).append(str)
				};
			}
		});
	})
	
	function upt_sts (id_toko, id_akun, sts_value){
		$.ajax({
			type:"POST",
			url:"<?=site_url('user_checkout/upt_sts')?>",
			data:"id_toko="+id_toko+"&id_akun="+id_akun+"&sts_value="+sts_value
		});
	}
</script>