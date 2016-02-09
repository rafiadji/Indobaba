<?php error_reporting(0); ?>
<div class="col-md-12">

			<div class="panel panel-default">
				<div class="panel-body">
					<div class=" col-md-12" id="tb">
					
			
<h2>
	<?php 
	if($id==1)
		echo 
		"<div style='border-left: 5px solid #FFE18D;background:rgba(16, 194, 212, 0.88);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;'>
			Orderan Baru <br/>
			<font size='2px'>Pesanan baru saja dilakukan oleh pembeli, silahkan konfirmasi pembayarannya!</font>
		</div>";
		
	elseif($id==2)
		echo
		"<div style='border-left: 5px solid #FFE18D;background:#337ab7;color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;'>
			Orderan Ditanggapi <br/>
			<font size='2px'>Pembayaran telah dikonfirmasi dan pesanan telah dikirim ke halaman Penjual. Anda juga bisa mengkonfirmasi ketersediaan pesanannya disini</font>
		</div>";
	elseif($id==3)
		echo
		"<div style='border-left: 5px solid #FFE18D;background:rgba(16, 194, 212, 0.88);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;'>
			Orderan Isi Resi
		</div>";
	elseif($id==4)
		echo
		"<div style='border-left: 5px solid #FFE18D;background:rgba(16, 212, 40, 0.88);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;'>
			Orderan Berhasil <br/>
			<font size='2px'>Pesanan telah berhasil dikonfirmasi maupun dikirim kepada pembeli.</font>
		</div>";
	else
		echo 
		"<div style='border-left: 5px solid #FFE18D;background:rgb(212, 97, 16);color:white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;'>
			Orderan Gagal <br/>
			<font size='2px'>Pesanan dari pembeli gagal karena pembayaran tidak diterima oleh indobaba</font>
		</div>";
	?>
</h2>
<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Transaksi</th>
								<th>Status<?php if($id==2) echo " Ditanggapi" ?></th>
								<?php if($id==2)
								{ ?>
								<th>Status Batal</th>
								<th>Status Resi</th>
								<?php } ?>
								<th>Tanggal</th>
								<th>Pembeli</th>
								<th>Total Bayar</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
<?php 
	$no = 1;
	if($tampil)
	{
	foreach($tampil as $row):
		?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo $row->ID_TRANS;?></a></td>
		<td><?php 
		if($id==2)
		{
			$stts = $this->db->query("SELECT  * FROM view_detail_transaksi WHERE STS_TANGGAP=1 AND ID_TRANS='$row->ID_TRANS' GROUP BY ID_TOKO")->result();
			//echo $this->db->last_query();
			$stt2 = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS' GROUP BY ID_TOKO")->result();
			echo count($stts)." Dari ".count($stt2)." Toko";
		}
		else
		{
			$stts = $this->db->query("SELECT * FROM mp_transaksi_status WHERE ID_STATUS='$row->ID_STATUS'")->row();
			echo $stts->STATUS;
		}
		?>
		</td>
		<?php
		if($id==2)
		{ ?>
		<td>
			<?php $sttss = $this->db->query("SELECT * FROM view_detail_transaksi WHERE STS_TAMPIL=0 AND ID_TRANS='$row->ID_TRANS'  GROUP BY ID_TOKO")->result();
			if($sttss) echo count($sttss); else echo 0; 
			echo " Toko Dibatalkan"?>
		</td>
		<td>
			<?php 
			$stts1 = $this->db->query("SELECT * FROM view_detail_transaksi WHERE STS_RESI=1 AND ID_TRANS='$row->ID_TRANS'")->result();
			$stt21 = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS' GROUP BY ID_TOKO")->result();
			echo count($stts1)." Dari ".count($stt21)." Toko";
			?>
		</td>
		<?php
		}
		?>
		<td><?php echo $row->TGL_TRANS." ".$row->WKT_TRANS; ?></td>
		<td><?php echo $row->NAMA; ?></td>
		<td>
		<?php 
		$hit = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS' AND STS_TAMPIL=1")->result();
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

		$ongk = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$row->ID_TRANS' AND STS_TAMPIL=1 GROUP BY ID_ONGKIR")->result();
		$ongkir=0;
		foreach ($ongk as $ss) {
			//echo $ss->ID_ONGKIR."-";
			$ongkir+=$ss->TOTAL_ONGKIR_REALISASI;
		}

		$unik = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$row->NO_TRANS'")->row();

		echo formatRp($h+$ongkir+$unik->KODE_UNIK);
		?></td>
		<td><a target="_detail" href="<?php echo site_url('admin_transaksi/detailTransaksi/'.base64_encode_fix($row->ID_TRANS)); ?>" class="btn btn-success">Detail</a></td>
	</tr>
	<?php
	endforeach; 
	}
	?>

						</tbody>
					</table>
							</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
    });
    var auto_refresh = setInterval(
    function ()
    {
         $.ajax( {
            type :"POST",
            url: "<?php echo site_url('admin_transaksi/table2/'.$id); ?>",
            cache :false,
            success : function(msg) {
                $("#tb").html(msg).show();
            },
            error : function() {
               alert('Error order');
            }
        });
    }, 5000);
    </script>