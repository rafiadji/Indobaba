<div id="products-tab" class="wow fadeInUp">
<div class="container">

    <div class="row">
    	<div class="col-md-12">
    		<h4>Hasil Pencarian Katalog "<?php echo $judul;?>"</h4>
    		<hr/>
    	</div>
    </div>
    
    <?php 
            	if($tampil):
            	$c = 0;
            ?>
	        <?php 
	        	foreach($tampil as $row):
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
                            <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>" class="le-button">Selengkapnya</a>
                        </div>
                        
                    </div>
                </div>
            </div>
			<?php
				if(($c % 4) == 0) echo '</div>';
				endforeach;
			?>
			<?php endif; ?>
		
        <div class="row">
    	<div class="col-md-12">
            <div class="pagination"><?php echo $halaman;?></div>    
    </div>
    </div>
</div>
</div>