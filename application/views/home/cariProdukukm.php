<div id="products-tab" class="wow fadeInUp">
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			<H1>Hasil pencarian " <?php echo $judul;?> "</H1>
    			<hr />
    		</div>
    	</div>
		<form method="POST" class="form-inline" action="<?php echo base_url();?>/home_controller/carikategori/<?php echo $idlink;?>">
				<div class="form-group">
					<input style="width: 300px;" type="text" placeholder="Cari produk dari kategori <?=$judul?>" name="cariprodukkategori" class="form-control col-md-8">
				</div>
				<div class="form-group">
					<input style="width: 100px;" type="text" placeholder="Harga Min" <?=$judul?>" name="min" class="form-control col-md-8">
				</div>-
				<div class="form-group">
					<input style="width: 100px;" type="text" placeholder="Harga Max" <?=$judul?>" name="max" class="form-control col-md-8">
				</div>
				<div class="form-group">
							<select name="urut" class="form-control col-md-8">
								<option value="semua">Semua Produk</option>
								<option value="baru">Terbaru</option>
								<option value="murah">Termurah</option>
								<option value="mahal">Termahal</option>
								<option value="laris">Terlaris</option>
							</select>
						</div>
				<div class="form-group">
					<input type="submit" name="cariprodukkategorisbt" class="btn btn-success" value="Cari">
				</div>
			</form>
            <?php 
            	if($tampill):
            	$c = 0;
            ?>
	        <?php 
	        	foreach($tampill as $row):
	        	$c++;
	        ?>
	        <?php if(($c % 4) == 1) echo '<div class="product-grid-holder">'; ?>
	        <?php $link = setPermalink($row->ID_PRODUK,$row->NM_PRODUK);?>
            <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                <div class="product-item">
                    <div class="image">
                        <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>">
                        	<?php foreach($this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE,1) as $row_gambar):?>
                                <img style="width:246px;height:186px;" src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/rs.php?ok=<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/rs.php?ok=none.jpg";endif;?>" alt="" />
                            <?php endforeach; ?>
                    	</a>
                    </div>
                    <div class="body">
                        <div class="title">
                            <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>"><?=$row->NM_PRODUK?></a>
                        </div>
                    </div>
                    <div class="prices">
                        <div class="price-current text-center"><?php $h_grosir = explode("|",$row->HARGA);$hh_grosir = explode("-",$h_grosir[0]);if($row->STS_GROSIR == 0):echo formatRp($row->HARGA);else: echo formatRp($hh_grosir[2]); endif;?></div>
                    </div>
                    <div class="hover-area">
                        <div class="add-cart-button">
                            <a href="single-product.html" class="le-button">Selengkapnya</a>
                        </div>
                        <div class="wish-compare">
                            <?php foreach($this->producthomemodel->tampilData("mp_toko","NM_TOKO",array("ID_TOKO" => $row->ID_TOKO)) as $row_namaukm): $nama_toko = str_replace(" ","-",$row_namaukm->NM_TOKO);echo anchor("Home_controller/ukm/$nama_toko",$row_namaukm->NM_TOKO,'class="btn-add-to-wishlist"'); endforeach;?>
                            <?php foreach($this->producthomemodel->tampilData("mp_kategori","*",array("ID_KATEGORI" => $row->ID_KATEGORI)) as $row_kategori):  endforeach; foreach($this->producthomemodel->tampildata("mp_sub_kategori","*",array("ID_SUB_KATEGORI" => $row->ID_SUB_KATEGORI)) as $row_subkategori): $link = setPermalink($row_subkategori->ID_SUB_KATEGORI,$row_subkategori->SUB_KATEGORI);echo anchor("home_controller/kategori/$link",$row_subkategori->SUB_KATEGORI,'class="btn-add-to-compare"'); endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
			<?php
				if(($c % 4) == 0) echo '</div>';
				endforeach;
			?>
			<?php else: ?>
			<div class="row">
				<div class="col-md-12">
					<div class="well well-lg">
						Tidak ada hasil untuk <?php echo $judul;?>. Kembali ke <a href="<?php echo base_url() ?>">halaman depan</a>
					</div>
				</div>
			</div>
			<?php endif; ?>
        <div class="row">
    	<div class="col-md-12">
            <div class="pagination"><?php echo $halaman;?></div>    
    </div>
    </div>
    </div>
</div>