<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<a href="<?php echo base_url('admin_produk/ubahProduk/'.$row->ID_PRODUK) ?>" class="btn btn-default btn-lg">Ubah Informasi Produk</a>
			<a href="<?php echo base_url('admin_produk') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-3">
	<div class="row">
	         <?php $a = 0; foreach($this->produkmodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE,0,1) as $row_gambar):?>
             	<?php
 
             		if($a == 0){
						$featured_img = 12;
						$size_img_width = '100%';
						
					}
					else{
						$featured_img = 4;
						$size_img_width = '65px';
					}
             	?>
             	<div class="col-md-<?php echo $featured_img ?> col-xs-<?php echo $featured_img ?>" style="margin-right: 0;">
				<a class="fancybox" rel="group" href="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>"><img class="thumbnail" <?php echo 'style="width:'.$size_img_width.'"' ?> src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>"></a>
             
			</div>
             <?php $a++;endforeach; ?>
	</div>
</div>
<div class="col-md-6">
			<div class="panel panel-default">
		<div class="panel-body">
			
			<table width="100%" class="">
				<tr>
					<td><i class="fa fa-eye"></i> Dilihat</td>
					<td><?=$row->HITS?></td>
					<td><i class="fa fa-archive"></i> Berat</td>
					<td><?php echo konversiGram($row->BERAT_PRODUK)?></td>
				</tr>
				<tr>
					<td><i class="fa fa-star"></i> Min. Pesan</td>
					<td><?=$row->MIN_PESAN?></td>
					<td><i class="fa fa-money"></i> Terjual</td>
					<td><?php echo $row->IN_CART?></td>
				</tr>
				<tr>
					<td><i class="fa fa-calendar"></i> Tgl Posting</td>
					<td><?= ubahFormatTgl($row->TGL_POS,'d-m-Y')?></td>
					<td><i class="fa fa-clock-o"></i> Wkt Posting</td>
					<td><?php echo $row->WKT_POS?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php if($row->STS_GROSIR != 0): ?>
		<div class="panel panel-default">
			<div class="panel-body">
				
				<table class="table table-striped">
					<tr>
						<td></td>
						<td>S/d</td>
						<td></td>
						<td>Harga</td>
					</tr>
				
				<?php
				$grosir = $row->HARGA;
				$data =  explode('|',$grosir);
                                $i = 0;
                                foreach($data as $key):
                                if($key != ""){
                                    $data2 = explode('-',$key);
                                    if($i == 0){$harga_satuan = $data2[2];}
                                    echo '<tr><td>'.$data2[0].'</td><td>-</td><td>'.$data2[1].'</td><td>'.formatRp($data2[2]).'</tr></td>';    
                                }
                                $i++;
                                endforeach;
                                
                                ?>
              </table>
			</div>
		</div>
	<?php endif; ?>
	<div class="panel panel-default">
                        <div class="panel-body"><?=$row->DES_PRODUK?></div>
                    </div>
	<div class="panel panel-default">
		<div class="panel-body">
			<?php
			$grosir = $row->HARGA;
                            $harga_satuan = "";
                            if($row->STS_GROSIR == 0):
                                $harga_satuan = formatRp($grosir);
                                echo '<div style="text-align:center;"><h1>'.$harga_satuan.'</h1></div>';
                            else :
                                $data =  explode('|',$grosir);
                                $i = 0;
                                    $data2 = explode('-',$data[0]);
                                    echo '<div style="text-align:center;"><h1 style="color:orange">'.formatRp($data2[2]).'</h1></div>';
                                
                            endif; 
			?>
		</div>
	</div>
</div>
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><i class="fa fa-home"></i> Info Produsen</h4>
		</div>
		<div class="panel-body">
			<?php
	            $id_toko = ''; 
	            foreach($this->produkmodel->tampilData("mp_toko","*",array("ID_TOKO" => $row->ID_TOKO)) as $row_ukm):
	        ?>
			<div class="form-group">
			 	<?php foreach($this->produkmodel->tampilData("mp_penanggung_jwb","*",array("ID_PENANGGUNG_JWB" => $row_ukm->ID_PENANGGUNG_JWB)) as $pj): ?>
			<label>Penanggung Jawab</label>
			<p><a href="<?php echo base_url('admin_penanggung_jwb/editPenanggungJwb/'.$pj->ID_PENANGGUNG_JWB) ?>"><?php echo $pj->NAMA; ?></a></p>
		
		<?php endforeach; ?>
			 </div>
			 
	        <div class="form-group">
	        	<label>Nama Produsen</label>
	        	<p><?php echo $row_ukm->NM_TOKO ?></p>
	        </div>
	        <div class="form-group">
	        	<label>Alamat</label>
	        	<p><?php echo $row_ukm->ALAMAT ?></p>
	        </div>
	        <div class="form-group">
	        	<label>No Telp</label>
	        	<p><?php echo $row_ukm->NO_TELP ?></p>
	        </div>
	         <?php
	                endforeach;
	          ?>
		</div>
		<div class="panel-footer">
			<a href="<?php echo base_url('admin_ukm/editUkm/'.base64_encode_fix($row_ukm->ID_TOKO))?>">Lihat informasi produsen</a>
		</div>
	</div>
</div>