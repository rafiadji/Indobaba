
	
		<?php if($id==2): ?>
			<div style="border-left: 5px solid #FFE18D;background:rgba(16, 194, 212, 0.88);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<h4>Orderan Masuk</h4>
	    	Ada orderan baru! Silahkan konfrimasi ketersediaan barang dan lakukan pengiriman barang. 
			</div>
		<?php elseif($id==3): ?>
			<div style="border-left: 5px solid #FFE18D;background:rgba(109, 16, 212, 0.88);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<h4>Isi Resi</h4>
	    	 Anda Telah mengkonfirmasi ketersediaan barang. Jika sudah melakukan pengiriman, silahkan masukan resi pengiriman ke transaksi!
			</div>
		<?php elseif($id==4): ?>
			<div style="border-left: 5px solid #FFE18D;background:rgba(16, 212, 40, 0.88);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<h4>Orderan Berhasil</h4>
			Anda Telah Melakukan Pengiriman. Transaksi yang anda lakukan berhasil!	    	
			</div>
		<?php elseif($id==5): ?>
			<div style="border-left: 5px solid #FFE18D;background:rgb(212, 97, 16);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<h4>Orderan Batal</h4>
	    	Transaksi Dibatalkan karena barang yang tersedia tidak sesuai dengan permintaan.
			</div>
		<?php endif; ?>
		
   
	<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>ID Transaksi</th>
								<th>Produk dipesan</th>
								<?php if($id==2):?><th>Status</th><?php endif;?>
								<th>Tanggal</th>
								<th>Total Tagihan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
<?php 
	$no = 1;
	if($tampil)
	{
	foreach($tampil as $row):
		$cekbukti= $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$row->NO_TRANS'")->row();
	if($cekbukti)
	{
		?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo $row->ID_TRANS;?></td>
		<td>
		<?php
		$produkkk = $this->db->query("SELECT * FROM view_detail_transaksi WHERE NO_TRANS = '$row->NO_TRANS'  AND ID_TOKO = '$row->ID_TOKO'")->result();
		//echo $produkkk->NM_PRODUK;
		//echo $this->db->last_query();
			foreach ($produkkk as $produkkkk) {
			echo $produkkkk->NM_PRODUK.", ";
			}
		?>
		</td>
				<?php if($id==2):
			echo "<td>";
			$stts = $this->db->query("SELECT * FROM view_detail_transaksi WHERE STS_RESI=1 AND ID_TRANS='$row->ID_TRANS'  AND ID_TOKO = '$row->ID_TOKO' GROUP BY ID_ONGKIR");
			
			$stt2 = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS'  AND ID_TOKO = '$row->ID_TOKO' GROUP BY ID_ONGKIR");
			if($stts)
				$a=$stts->num_rows();
			else
				$a=0;

			if($stt2)
				$b=$stt2->num_rows();
			else
				$b=0;


			echo $a." Dari ".$b." Resi Terisi.";
			echo "</td>";
		 endif;?>
		<td><?php echo $row->TGL_TRANS." ".$row->WKT_TRANS; ?></td>

		<td>
		<?php 
		if($id != 5){
			$hit = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS' AND STS_TAMPIL=1 AND ID_TOKO = '$row->ID_TOKO'")->result();
		
		}
		else{
			$hit = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$row->ID_TRANS' AND STS_TAMPIL=1 AND ID_TOKO = '$row->ID_TOKO'")->result();
		
		}
		$h=0;
		//$pj=0;
		$ind=0;
		foreach ($hit as $ke) {
			$h+=$ke->HARGA_PER*$ke->QTY_TERSEDIA; 
			$keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
			$keuntungan1 =($keu->KEUNTUNGAN_UKM/100)*($ke->HARGA_PER*$ke->QTY_TERSEDIA);
			$keuntungan2 =($keu->KEUNTUNGAN_PJ/100)*($ke->HARGA_PER*$ke->QTY_TERSEDIA);
			$ind+=$keuntungan1+$keuntungan2;
		}
		if($id != 5){
		$ongk = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS' AND ID_TOKO = '$row->ID_TOKO'  AND STS_TAMPIL=1 GROUP BY ID_ONGKIR")->result();
		$ongkir=0;
		foreach ($ongk as $ss) {
			//echo $ss->ID_ONGKIR."-";
			$ongkir+=$ss->TOTAL_ONGKIR_REALISASI;
		}

		}else{
		$ongk = $this->db->query("SELECT * FROM view_trans_batal WHERE ID_TRANS='$row->ID_TRANS' AND ID_TOKO = '$row->ID_TOKO'  AND STS_TAMPIL=1 GROUP BY ID_ONGKIR")->result();
		$ongkir=0;
		foreach ($ongk as $ss) {
			//echo $ss->ID_ONGKIR."-";
			$ongkir+=$ss->HARGA_ONGKIR;
		}	
		}
		

		$unik = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$row->NO_TRANS'")->row();
		$hasil_akhir = ($h+$ongkir)-$ind; echo formatRp($hasil_akhir);

		?></td>
		<td><?php if($id == 4):?><a target="_detail" href="<?php echo site_url("ukm_info/ubahdata/2/".base64_encode_fix($row->ID_TRANS)); ?>" class="btn btn-info">Ubah Data</a><?php endif;?><a target="_detail" href="<?php echo site_url("ukm_info/detailTransaksi/$id/".base64_encode_fix($row->ID_TRANS)); ?>" class="btn btn-success">Detail</a></td>
	</tr>
	<?php 
	}	
	endforeach; 
	}
	?>

						</tbody>
					</table>
	

<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
    });
    </script>