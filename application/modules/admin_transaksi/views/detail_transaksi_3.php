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

	<form id="cok" method="POST">
	<input type="hidden" name="no_trans" value="<?php echo $pembeli->NO_TRANS; ?> "><!-- Ini UNTUK nO Trans -->
	<input type="hidden" name="id_trans" value="<?php echo $pembeli->ID_TRANS; ?> " id="id_trans"><!-- Ini UNTUK nO Trans -->
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
					<label>Tanggal Transaksi</label>
					<p><?php echo $pembeli->TGL_TRANS; ?></p>
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
				<h4>Bukti Transfer    </h4>
				<hr/>
				<div style="color:red" class="form-group">
					<label>Total Transfer</label>
					<p><span id="nominalnya"></span></p>
				</div>
				<div style="color:red" class="form-group">
					<label>Total Tagihan</label>
					<p><span id="tghn"></span></p>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<p><?php echo $ss->TGL_TRANSFER; ?></p>
				</div>
				<div class="form-group">
					<label>No Rekening Pengirim</label>
					<p><?php echo $ss->NO_REKENING; ?></p>
				</div>
				<div class="form-group">
					<label>Atas Nama Pengirim</label>
					<p><?php echo $ss->ATAS_NAMA; ?></p>
				</div>
				<div class="form-group">
					<label>Nama Bank Tujuan</label>
					<?php $qii = $this->db->query("SELECT * FROM mp_bank WHERE ID_BANK='$ss->BANK_TUJUAN'")->row(); ?>
					<p><?php if($qii) echo $qii->BANK; ?></p>
				</div>
				<div class="form-group">
					<label>Kode Unik</label>
					<p><?php echo $ss->KODE_UNIK; ?></p>
				</div>
				<div class="form-group">
					<label>Foto Bukti</label>
					<p><a href="#" data-toggle="modal" data-target="#buktiModal">Foto Bukti Pembayaran</a></p>
				</div>
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
							  $keuntungan1 =($keu->KEUNTUNGAN_UKM/100)*$totharga2;
							  $tot_web+=$keuntungan1;
							 	echo formatRp($keuntungan1);
						?>
						</td>
						<td>
						<?php $keu = $this->db->query("SELECT * FROM mp_keuntungan LIMIT 1")->ROW(); 
							  $keuntungan2 =($keu->KEUNTUNGAN_PJ/100)*$totharga2;
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
	    				 	<div class="form-group">
								<label>Masukan Resi : </label>
								<?php $q=$this->db->query("SELECT * FROM mp_cart WHERE ID_TRANS='$pembeli->ID_TRANS' AND ID_ONGKIR='$key->ID_ONGKIR'")->row(); ?>
							 	<input type="text" class="form-control" style="width:300px" value="<?php if($q) echo $q->RESI; ?>" required  id='resi<?php  echo $key->ID_ONGKIR ?>' class="resi[]"> 
							</div>
							<a href="#" onclick="resi(<?php echo $key->ID_ONGKIR; ?>)" class="btn btn-success">Kirim Resi</a>
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
		        			<input type="submit" value="Resi Valid" class="btn btn-success">
		        			<!--<a href="#" onclick="resivalid()" class="btn btn-success">Resi Valid</a>-->
		        			<a href="<?php echo site_url('admin_transaksi'); ?>" class="btn btn-danger">Resi Belum Lengkap</a>
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
    function resi(id_ongkir) 
   {
		$(".loader").fadeIn();
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/isiresi'); ?>",
            cache :false,
            data: "no_trans="+<?php echo $pembeli->NO_TRANS; ?>+"&id_ongkir="+id_ongkir+"&id_trans=<?php echo $pembeli->ID_TRANS; ?>&resi="+$("#resi"+id_ongkir).val(),
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
    $("#cok").submit(function(){
   		if(confirm("Pastikan Resi Sudah Terisi di Transaksi ini, Jika Belum Mohon Klik Resi Belum Lengkap."))
   		{
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('admin_transaksi/resivalid'); ?>",
            cache :false,
            data: "id_trans=<?php echo $pembeli->ID_TRANS; ?>",
            success : function(msg) {
              alert("Berhasil menyimpan data.");
              window.location.href="<?php echo site_url('admin_transaksi'); ?>";
            },
            error : function() {
               
            }
        });
    	return false;
    	}
    });
    $(window).load(function() {
    $(".loader").fadeOut(500);
})
	</script>