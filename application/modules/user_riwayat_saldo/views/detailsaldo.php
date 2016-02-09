<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-9">
				<?php if ($toko) :?>
				<?php
					// endif;
				$k = 0;
				foreach ($toko as $tk) : 
				$m = 0;
				// cek status toko
				$cek_toko = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND NO_TRANS = '$tk->NO_TRANS'")->result();
				$penuh = 0;
				foreach ($cek_toko as $c_tk) {
					if ($c_tk->STS_TANGGAP == 1) {
						if  ($c_tk->STS_TAMPIL == 0){
							$label = "danger";
							$kata = "dibatalkan";
							$head_panel = "background:red;";
							$body_panel = "background:#F5F5F5;";
							break;
						}	
						elseif ($c_tk->QTY_TERSEDIA == $c_tk->QTY) {
							$label = "success";
							$kata = "terpenuhi";
							$head_panel = "";
							$body_panel = "";	
						}
						else{
							$label = "info";
							$kata = "terpenuhi sebagian";
							$penuh = 1;
							$head_panel = "background:#5BC0DE;";
							$body_panel = "background:#F5F5F5";
							break;
						}
					}
					else{
						$label = "warning";
						$kata = "belum ditanggapi";
						$head_panel = "";
						$body_panel = "";
					}
				}	
				?>
					<div class="panel panel-default">
						<div class="panel-heading" style="<?=@$head_panel?>">
							<table width="100%">
								<tr>
									<td width="40%"><h3 style="color: #F27A24"><?php echo $tk->NM_TOKO; ?></h3><?php if($stat->ID_STATUS == 2 || $stat->ID_STATUS == 3 || $stat->ID_STATUS == 4){?><span class="label label-<?=$label?>"><?=$kata?></span> <?php } ?></td>
									<td style="font-size:12px;text-align: left;">Apabila stok yang tersedia hanya sebagian : 
									<b><?php if($tk->STATUS_TERSEDIA == 0){echo "Batalkan keseluruhan pesanan";}else{echo "Kirimkan stok yang tersedia";}?></b>
									<?php if(@$penuh == 1):?>
									<button type="button" class="btn btn-info" data-toggle="modal" data-target=".pawalmodal<?=$k?>">Permintaan awal</button>
									<?php include('orla_modal.php'); endif;?>
									</td>
								</tr>
							</table>
						</div>
						<div class="panel-body panel-cart-puji" style="<?=@$body_panel?>">
							
							<?php 
					$alamat = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND NO_TRANS = '$tk->NO_TRANS' GROUP BY ID_ALAMAT")->result();
					foreach ($alamat as $al) : ?>
						<div class="row">
							<div class="col-md-12">
								<table class="table" width="10%">
									<tr>
										<th>Nama Penerima</th>
										<td> : </td>
										<td><?php echo $al->NAMA_PENERIMA; ?></td>
									</tr>
									<tr>
										<th>Alamat Tujuan</th>
										<td> : </td>
										<td><?php echo $al->ALAMAT. " <br/><b>".$al->KODE_POS." , ".getKabupatenRj($al->PROVINSI, $al->KOTA_KAB).", ".getProvinsiRj($al->PROVINSI)." </b>"; ?></td>
									</tr>
									<tr>
										<th>Telp Penerima</th>
										<td> : </td>
										<td><?php echo $al->NO_HP_PENERIMA; ?></td>
									</tr>
								</table>
							</div>
						</div>
						<?php 
							$kurir = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND NO_TRANS = '$tk->NO_TRANS' GROUP BY ID_ONGKIR")->result();
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
							</tr>
							<?php 
							$i = 0;
							$pro = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND ID_ONGKIR = '$kr->ID_ONGKIR' AND NO_TRANS = '$tk->NO_TRANS'")->result();
							foreach ($pro as $pr) : 
								if (@$penuh == 1){
									$qty = $pr->QTY_TERSEDIA;
									$tot = $kr->TOTAL_REALISASI;
								}
								else {
									$qty = $pr->QTY;
									$tot = $kr->TOTAL;
								}
							?>
								<tr>
									<td><a href="<?=base_url()?>Home_controller/detailProduct/<?php echo $pr->ID_PRODUK; ?>"><?php echo $pr->NM_PRODUK; ?></a></td>
									<td><?php echo $qty; ?></td>
									<td><?php echo konversiGram($pr->BERAT_PRODUK); ?></td>
									<td><?php echo konversiGram($qty * $pr->BERAT_PRODUK); ?></td>
									<td><?php echo formatRp($pr->HARGA_SATUAN); ?></td>
									<td><?php echo formatRp($qty * $pr->HARGA_SATUAN); ?></td>
									<!-- <td><?php // echo formatRp($pr->TOTAL).'<br/>('.strtoupper($pr->NAMA_KURIR).', '.$pr->PAKET_YANG_DIAMBIL.')'; ?></td> -->
									<?php 
									$pro_harga[$i] = ($pr->QTY * $pr->HARGA_SATUAN); 
									$pro_harga_sedia[$i] = ($pr->QTY_TERSEDIA * $pr->HARGA_SATUAN); 
									$pro_berat[$i] = ($pr->QTY * $pr->BERAT_PRODUK);?>
								</tr>
							<?php $i++; endforeach; ?>
							<?php 
							for ($f=0; $f < $i; $f++) {
								$pro_berat[$f] += @$pro_berat[$f-1];
							}?>
							<?php $resi = $this->db->query("SELECT * FROM view_checkout WHERE ID_TOKO = '$tk->ID_TOKO' AND NO_TRANS = '$tk->NO_TRANS' AND ID_ONGKIR = '$kr->ID_ONGKIR'")->row();?>
							<tr>
								<?php if($stat->ID_STATUS == 1 || $stat->ID_STATUS == 5 || $stat->ID_STATUS == 9):?>
									<td colspan="3">Ekspedisi : <?php echo strtoupper($kr->NAMA_KURIR); ?> ( <?php echo $kr->PAKET_YANG_DIAMBIL ?> ) / <?php echo formatRp($tot) ?> </td>
									<td><?=konversiGram($pro_berat[$f-1])?></td>
									<td colspan="2"></td>
								<?php else:?>
									<td colspan="3">Ekspedisi : <?php echo strtoupper($kr->NAMA_KURIR); ?> ( <?php echo $kr->PAKET_YANG_DIAMBIL ?> ) / <?php echo formatRp($tot) ?> </td>
									<td><?=konversiGram($pro_berat[$f-1])?></td>
									<?php if(!empty($resi->RESI)) : ?>
									<td colspan="2">Resi : <?=$resi->RESI?></td>
									<?php else:?>
									<td colspan="2"><span class="label label-warning">resi belum ada</span></td>
									<?php endif;?>
								<?php endif;?>
							</tr>
							</table>
							<?php 
							for ($n=0; $n < $i; $n++) {
								$pro_harga[$n] += @$pro_harga[$n-1];
								$pro_harga_sedia[$n] += @$pro_harga_sedia[$n-1];
							}
							$tot_harga[$m] = $pro_harga[$n-1] + $kr->TOTAL;
							$tot_harga_sedia[$m] = $pro_harga_sedia[$n-1] + $kr->TOTAL_REALISASI;
							?>
						<?php $m++; endforeach; ?>
					<?php endforeach; ?>
					<!-- SEK -->
					<?php 
					for ($j=0; $j < $m; $j++) {
						$tot_harga[$j] += @$tot_harga[$j-1];
						$tot_harga_sedia[$j] += @$tot_harga_sedia[$j-1];
					}
					$tot_tag[$k] = @$tot_harga[$j-1];
					$tot_tag_sedia[$k] = @$tot_harga_sedia[$j-1];?>
					<?php if(@$penuh == 1):?>
					<p>Saldo yang didapat di <?=$tk->NM_TOKO?> : <?=formatRp($tot_tag[$k] - $tot_tag_sedia[$k])?></p>
					<?php elseif($tk->STS_TAMPIL == 0):?>
					<p>Saldo yang didapat di <?=$tk->NM_TOKO?> : <?=formatRp($tot_tag[$k])?></p>
					<?php endif;?>
			</div>
		</div>
	<?php $k++; endforeach; ?>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default inherit">
				<div class="panel-heading" style="background-color:#72ff00">
					<h4 style="color: white" align="center"><strong>RINGKASAN TRANSAKSI</strong></h4>
					
				</div>
				<div class="panel-body" style="background-color:rgba(140, 140, 140, 0.09)">
				<p>ID : <?=$tk->ID_TRANS?></p>
				<hr style="color:white" />
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
					 <td><p><?php echo $tk->KODE_UNIK;?></p></td>
				 </tr>
				 <?php $saldo = $this->db->query("SELECT * FROM mp_riwayat_saldo WHERE NO_TRANS = '$tk->NO_TRANS'");
				 if($saldo->num_rows() > 0):?>
				 <tr> 
				 	<?php $saldo = $saldo->row()?>
					 <td><p>Saldo dari transaksi ini</p></td>
					 <td><p>&nbsp;:&nbsp;</p></td>
					 <td><p><?php echo formatRp($saldo->SALDO);?></p></td>
				 </tr>
				 <?php endif;?>
				</table>
				<br>
				<p>Total Bayar :</p>
				<p style="font-size:35px; color:#F27A24;"><?php echo formatRp($tot_tag[$l-1] + $tk->KODE_UNIK); ?></p>

				<?php if($stat->ID_STATUS == 1 && $stat->STS_BAYAR == 0) :?>
				<div class="form-group">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#bayarModal">Pembayaran</button>
				</div>
				<?php include('bayar_modal.php'); 
				elseif($stat->ID_STATUS == 5 && $stat->STS_BAYAR == 1): ?>
				<div class="form-group">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#bayarModal">Pembayaran</button>
				</div>
				<?php include('bayar_modal.php');
				endif; ?> 
				</div>
			</div>
		</div>
	<?php endif;?>
	</div>
</div>