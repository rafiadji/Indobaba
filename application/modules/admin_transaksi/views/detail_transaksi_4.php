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
		<div class="panel panel-success">
			<div class="panel-heading">
				<h4 align="center">ORDERAN BERHASIL</h4>
			</div>
		</div>
	</div>

	<div class="col-md-7">
		<div class="panel panel-default" >
		<br/>
			<div style="border-left: 5px solid #8BC34A;background: rgba(210, 210, 210, 0.37);color:black;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;margin-top: 10px;margin-bottom:10px;">
			<p style="text-align:justify"><b><i>Orderan baru</i></b> adalah transaksi yang baru di lakukan oleh pembeli namun belum di konfirmasi pembayarannnya oleh admin. Silahkan klik tombol <span style="color:green">"Konfirmasi" </span>  berwarna hijau di panel "Bukti Transfer" bila pembayaran di transaksi ini sudah diterima oleh indobaba, apabila pembayaran belum diterima silahkan klik tombol <span style="color:red">"Tidak Valid"</span> berwarna merah maka transaksi akan dikembalikan kepada pembeli</p>
			
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
		foreach ($toko as $tok) { ?>
		<div class="panel panel-default">
			<div class="panel-body">
			<h3><?php echo $tok->NM_TOKO ?></h3>
			<?php if($tok->STATUS_TERSEDIA==1)
				{ ?>
			<input type="hidden" name="id_toko[]" value="<?php echo $tok->ID_TOKO; ?>">
				<?php } ?>
			<div class="form-group">
				<p><?php echo $tok->ALAMAT_TOKO ?> ( <?php echo $tok->NO_TELP_TOKO ?> )</p>
				<?php $cekadatdak = $this->db->query("SELECT * FROM mp_kirim_rekening WHERE ID_TRANSAKSI='$pembeli->ID_TRANS' AND ID_TOKO='$tok->ID_TOKO'")->num_rows(); ?>
				<?php if($cekadatdak==0): ?>
				<a class="btn btn-primary" onclick="kirimrekening(<?php echo $tok->ID_TOKO; ?>,'<?php echo $id; ?>')">Kirim Ke Rekening <?php echo $tok->NM_TOKO ?></a>
				<?php else: ?>
				<a class="btn btn-success" onclick="kirimrekening(<?php echo $tok->ID_TOKO; ?>,'<?php echo $id; ?>')">Uang Sudah Terkirim Ke <?php echo $tok->NM_TOKO ?></a>
				<?php endif; ?>
			</div>
			<hr/>
			<?php
			$datanya = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO='$tok->ID_TOKO' GROUP BY ID_ALAMAT_PENERIMA")->result();
			$tot_harga=0;
			$tot_ongkir=0;
			$pj_tot=0;
			$web_tot=0;
			$ongkir=0;
			$ku_web=0;
			$ku_pj=0;
			$tot_harga2=0;
			?>
			<p>Bila Tersedia Sebagian : 
				<?php
				if($tok->STATUS_TERSEDIA==1)
				{
					echo "Kirim yang tersedia";
				}
				else if($tok->STATUS_TERSEDIA==0)
				{
					echo "Batalkan Transaksi";
				}
				?>
			</p>
			
			<?php foreach($datanya as $deta){
			?>
				<h4>Info Penerima</h4>
				Nama : <?php echo $deta->NAMA_PENERIMA; ?><BR>
				Alamat : <?php echo $deta->ALAMAT_PENERIMA; ?><BR>
				Telp : <?php echo $deta->NO_HP_PENERIMA; ?><br><br>
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
		        	<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Jumlah Dipesan</th>
						<th>Berat Satuan</th>
						<th>Total Berat</th>
						<th>Harga Satuan</th>
						<?php if($tok->STATUS_TERSEDIA==1){ ?>
						<th>Stok Tersedia</th>
						<?php } ?>
						<th>Total Harga Dipesan</th>
						<th>Keu WEB</th>
						<th>Keu PJ</th>
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
			    	foreach($lala as $detail){ ?>
			    	<tr>
			    		<td><?php echo $no++; ?></td>
						<td><?php echo $detail->NM_PRODUK; ?></td>
						<td><?php echo $detail->QTY; ?></td>
						<td><?php echo konversiGram($detail->BERAT_PRODUK); ?></td>
						<td><?php echo konversiGram($detail->BERAT_PRODUK*$detail->QTY_TERSEDIA); ?></td>
						<td><?php echo formatRp($detail->HARGA_PER); ?></td>
						<?php if($tok->STATUS_TERSEDIA==1){ ?>
						<td>
							<?php echo $detail->QTY_TERSEDIA; ?>
						</td>
						<?php } ?>
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
						<input type="hidden" value="<?php echo $detail->ID_CART; ?>" id="cart" class="cart[]" name="cart[]" required/>
					<tr>
			    	<?php } ?>
			       </tbody>
			       <tfoot>
			       	<tr>
			       		<?php if($tok->STATUS_TERSEDIA==1){ ?>
			       		<td colspan="7">Jumlah</td>
			       		<?php }
			       		else{ ?>
			       		<td colspan="6">Jumlah</td>
			       		<?php } ?>
			       		<td><?php $tot_harga2+=$tot_akh2; echo formatRp($tot_akh2);?></td>
			       		<td><?php $ku_web += $tot_web; echo formatRp($tot_web); ?></td>
			       		<td><?php $ku_pj += $tot_pj; echo formatRp($tot_pj);  ?></td>
			       		
			       		
			       	</tr>
			       	<tr>
			       		<?php if($tok->STATUS_TERSEDIA==1){ ?>
			       		<td colspan="10" style="color:black;font-size:12pt">
			       		<?php }
			       		else{ ?>
			       		<td colspan="9" style="color:black;font-size:12pt">
			       		<?php } ?>
			       		<b>
			       		Ongkir <?php echo strtoupper($key->NAMA_KURIR)." - ".$key->PAKET_YANG_DIAMBIL; ?>
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
			       </tfoot>
		        </table>
				</table>
		         <?php
		     }
		}
		       ?>
		<hr/>
		
			<?php 
			}
			?>

			        
		        <div class="row">
		        	<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Total Ongkir
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php  
		        				echo formatRp($ongkir); ?></h2>
		        			</div>
		        		</div>
		        	</div>
		        	<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Tagihan Untuk pembeli
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php 
		        				$tg+=$tot_harga2+$ongkir;
		        				echo formatRp($tot_harga2+$ongkir); ?></h2>
		        			</div>
		        		</div>
		        	</div>
					<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Dibayar Ke UKM
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php echo formatRp(($tot_harga2+$ongkir)-($ku_web+$ku_pj)); ?></h2>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		        
			</div>
		</div>
			<?php
		}
		 ?>
		  <div class="row">
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
		  </div>	
		  <div class="row">
		        	<div class="col-md-6">
		        		<div class="panel panel-default">
		        			<a href="<?php echo site_url('admin_transaksi/tabel/4'); ?>" class="btn btn-danger">Kembali</a>
		        		</div>
		        	</div>
		  </div>	
	</div>
	</form>
	<script>
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