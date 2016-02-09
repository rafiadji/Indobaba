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
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>Rincian Tagihan</h4>
				<hr/>
				<div class="form-group">
					<label>ID Transaksi</label>
					<p><?php echo $id; ?></p>
				</div>
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
	</div>
	<?php  $ss = $this->db->query("SELECT * FROM mp_bukti WHERE NO_TRANS='$pembeli->NO_TRANS'")->row(); 
	if($ss)
	{
	?>	
	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-body">
				<h4>Bukti Transfer</h4>
				<hr/>
				<div class="form-group">
					<label>Atas Nama</label>
					<p><?php echo $ss->ATAS_NAMA; ?></p>
				</div>
				<div class="form-group">
					<label>Tanggal Transfer</label>
					<p><?php echo $ss->TGL_TRANSFER; ?></p>
				</div>
				<div class="form-group">
					<label>No Rekening</label>
					<p><?php echo $ss->NO_REKENING; ?></p>
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<p><a href="#<?php// echo site_url('admin_transaksi/ft_bukti/'.base64_encode_fix($ss->NO_TRANS)); ?>" data-toggle="modal" data-target="#buktiModal>Foto Bukti Pembayaran</a></p>
				</div>
				<?php include('bukti_modal.php'); ?>
				<?php if($pembeli->ID_STATUS==4){ ?>
				<div class="form-group">
					<a href="#" onclick="do_menunggu_konfirmasi_admin(<?php echo $pembeli->NO_TRANS; ?>)" class="btn btn-success">Konfirmasi</a>
					<a href="#" onclick="do_konfirmasi_ulang(<?php echo $pembeli->NO_TRANS; ?>)" class="btn btn-danger">Tidak Valid</a>
				</div>
				<?php } ?> 
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
		foreach ($toko as $tok) {?>
		<div class="panel panel-default">
			<div class="panel-body">
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
			<hr />
			
<?php 
			//$alamat = $this->db->query("SELECT * FROM view_checkout WHERE ID_AKUN = '$akun' AND ID_TOKO = '$tk->ID_TOKO' GROUP BY ID_ALAMAT")->result();
			//echo "SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_ALAMAT_PENERIMA='$tok->ID_ALAMAT_PENERIMA'";
			$datanya = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' AND ID_TOKO='$tok->ID_TOKO' GROUP BY ID_ALAMAT_PENERIMA")->result();
			$tot_harga=0;
			$tot_ongkir=0;
			$pj_tot=0;
			$web_tot=0;
			$web_tot=0;
			if($pembeli->ID_STATUS==2){ ?>
			<a href="#" onclick="kirimemail('<?php echo $id; ?>',<?php echo $tok->ID_TOKO; ?>)" class="btn btn-info">Kirim Email Ke <b><?php echo  $tok->NM_TOKO;  ?> ( <?php echo  $tok->EMAIL;  ?> )</b></a>
			<?php
			}
			foreach($datanya as $deta){
			?>
				<h4>Info Penerima</h4>
				Nama : <?php echo $deta->NAMA_PENERIMA; ?><BR>
				Alamat : <?php echo $deta->ALAMAT_PENERIMA; ?><BR>
				Telp : <?php echo $deta->NO_HP_PENERIMA; ?><br><br>

				<table id="example1" class="table table-bordered table-striped">
		        <thead>
		        	<tr>
						<th>No</th>
						<th>Produk</th>
						<th>QTY</th>
						<th>Berat @</th>
						<th>Harga @</th>
						<th>Total Berat</th>
						<th>Total Harga</th>
						<th>Ongkir</th>
						<th>Total</th>
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
			    	$lala = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_TRANS='$id' and ID_AKUN = '$pembeli->ID_AKUN' AND ID_TOKO = '$tok->ID_TOKO' AND ID_ALAMAT_PENERIMA = '$deta->ID_ALAMAT_PENERIMA'")->result();
			    	foreach($lala as $detail){ ?>
			    	<tr>
			    		<td><?php echo $no++; ?></td>
						<td><?php echo $detail->NM_PRODUK; ?></td>
						<td><?php echo $detail->QTY; ?></td>
						<td><?php echo $detail->BERAT_PRODUK; ?></td>
						<td><?php echo formatRp($detail->HARGA_PER); ?></td>
						<td><?php echo konversiGram($detail->BERAT_PRODUK*$detail->QTY); ?></td>
						<td><?php $totharga = $detail->HARGA_PER*$detail->QTY; $tot_harga+=$totharga; echo formatRp($detail->HARGA_PER*$detail->QTY); ?></td>
						<td><?php $tot_ongkir +=$detail->HARGA_ONGKIR; $tot_akh_ongkir +=$tot_ongkir; echo formatRp($detail->HARGA_ONGKIR); ?></td>
						<td><?php $tot_akh += $totharga+$detail->HARGA_ONGKIR; echo formatRp($totharga+$detail->HARGA_ONGKIR); ?></td>
						<td>
						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
							  $keuntungan1 =	($keu->KEUNTUNGAN_UKM/100)*$totharga;
							  $tot_web+=$keuntungan1;
							  $web_tot+=$keuntungan1;
							  echo formatRp($keuntungan1);
						?></td>
						<td>
						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
							  $keuntungan2 =	($keu->KEUNTUNGAN_PJ/100)*$totharga;
							  $pj_tot+=$keuntungan2;
							  $tot_pj+=$keuntungan2;
							  echo formatRp($keuntungan2);
						?></td>
						
					<tr>
			    	<?php } ?>
			       </tbody>
			       <tfoot>
			       	<tr>
			       		<td colspan="7">Jumlah</td>
			       		<td><?php echo formatRp($tot_ongkir); ?></td>
			       		<td><?php echo formatRp($tot_akh); ?></td>
			       		<td><?php echo formatRp($tot_web); ?></td>
			       		<td><?php echo formatRp($tot_pj); ?></td>
			       		
			       	</tr>
			       </tfoot>
		        </table>

		<hr />
			<?php 
			}
			?>
			        <div class="row">
		        	<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Tagihan ke pembeli
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php  
		        				$tg +=$tot_harga+$tot_ongkir;
		        				echo formatRp($tot_harga+$tot_ongkir); ?></h2>
		        			</div>
		        		</div>
		        	</div>
					<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Dibayar UKM
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php echo formatRp(($tot_harga+$tot_ongkir)-($pj_tot+$web_tot)); ?></h2>
		        			</div>
		        		</div>
		        	</div>
					<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Dibayar ke Penanggung Jawab
		        			</div>
		        			<div class="panel-body">
		        				<h5><?php echo $deta->NAMA_PJ; ?></h5>
		        				<h5><?php echo $deta->ALAMAT_PJ." (".$deta->TELP_PJ.")"; ?></h5>
		        				<h2><?php echo formatRp($pj_tot); ?></h2>
		        			</div>
		        		</div>
		        	</div>
		        	<div class="col-md-3">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Keuntungan Indobaba
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php 
		        				$pjs +=$web_tot;
		        				echo formatRp($web_tot); ?></h2>
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
		        	<div class="col-md-6">
		        		<div class="panel panel-default">
		        			<div class="panel-heading">
		        				Total Pemasukan Indobaba
		        			</div>
		        			<div class="panel-body">
		        				<h2><?php echo formatRp($pjs); ?></h2>
		        			</div>
		        		</div>
		        	</div>
		  </div>	
	</div>
	<div class="col-md-12">

	<?php if($pembeli->ID_STATUS==2){ ?>
		<a href="#" onclick="barang_ada(<?php echo $pembeli->NO_TRANS; ?>)" class="btn btn-info">Konfirmasi Barang Ada</a>
	<?php } ?>
	<?php if($pembeli->ID_STATUS==7){ ?>
		<input type="submit" value="Kirim Resi Ke Pembeli" class="btn btn-success">
	<?php } ?>
		<a href="<?php echo site_url('admin_transaksi'); ?>"  class="btn btn-default">Kembali</a>
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
	function barang_ada(no_trans)
	{
		 $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/barang_ada') ?>",
              cache :false,
              data: "no_trans=" + no_trans ,
              success : function(msg) {
                  alert(msg);
                  window.location.href="<?php echo site_url('admin_transaksi'); ?>";
              },
              error : function() {
                  //$('#data_s3').replaceWith('Error');
              }
          });
	}
	function do_menunggu_konfirmasi_admin(no_trans)
	{
		 $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/do_menunggu_konfirmasi_admin') ?>",
              cache :false,
              data: "no_trans=" + no_trans ,
              success : function(msg) {
                  alert(msg);
                  location.reload(); 
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
                  location.reload(); 
              },
              error : function() {
                  //$('#data_s3').replaceWith('Error');
              }
          });
	}
	function kirim_resi()
	{
		//alert();

		
	}
	$("#testForm").submit( function() {
		//alert("asas");
          $.ajax( {
              type :"POST",
              url :"<?php echo site_url('admin_transaksi/kirim_resi') ?>",
              cache :false,
              data: $('form').serialize(),
              success : function(msg) {
                  alert("Berhasil Kirim Resi");
                  window.location.href="<?php echo site_url('admin_transaksi'); ?>";
              },
              error : function() {
                  //$('#data_s3').replaceWith('Error');
              }
          });
           return false;
     });
	</script>