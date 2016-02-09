<div class="modal fade pawalmodal<?=$k?>" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Pemesanan awal</h4>
			</div>
			<div class="modal-body">
				<?php 
            	$alamat = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND NO_TRANS = '$tk->NO_TRANS' GROUP BY ID_ALAMAT")->result();
				foreach ($alamat as $al):?>
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
					foreach ($kurir as $kr):?>
					<table class="table table-striped table-bordered">
						<tr class="info">
							<th>Nama Produk</th>
							<th>Qty</th>
							<th>Berat@</th>
							<th>Total Berat</th>
							<th>Harga@</th>
							<th>Total Harga</th>
						</tr>
						<?php 
							$pro = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND ID_ONGKIR = '$kr->ID_ONGKIR' AND NO_TRANS = '$tk->NO_TRANS' ")->result();
							foreach ($pro as $pr):?>
							<tr>
								<td><a href="<?=base_url()?>Home_controller/detailProduct/<?php echo $pr->ID_PRODUK; ?>"><?php echo $pr->NM_PRODUK; ?></a></td>
								<td><?php echo $pr->QTY; ?></td>
								<td><?php echo konversiGram($pr->BERAT_PRODUK); ?></td>
								<td><?php echo konversiGram($pr->QTY * $pr->BERAT_PRODUK); ?></td>
								<td><?php echo formatRp($pr->HARGA_SATUAN); ?></td>
								<td><?php echo formatRp($pr->QTY * $pr->HARGA_SATUAN); ?></td>
							</tr>
							<?php endforeach;?>
							<tr>
								<td colspan="6">Ekspedisi : <?php echo strtoupper($kr->NAMA_KURIR); ?> ( <?php echo $kr->PAKET_YANG_DIAMBIL ?> ) / <?php echo formatRp($kr->TOTAL) ?> </td>
							</tr>
					</table>
					<?php endforeach;?>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>