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

            <div class="col-sm-4 col-md-2  no-margin product-item-holder hover">

                <div class="product-item">

                    <div class="image" style="padding: 16px;">

                        <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>">

                        	<?php foreach($this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE,1) as $row_gambar):?>

                                <img style="height:120px;" src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/rs.php?ok=<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/rs.php?ok=none.jpg";endif;?>" alt="" />

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
              <div class="row">
        <div class="col-md-12">
            <div class="pagination">
                <a <?php if($page <= 1){ echo "disabled";} $prev = ($page-1);?>  onclick="halaman(<?php echo $prev; ?>)" class="btn"> < </a>
                <label class="btn">Halaman <?php echo $page;?> dari <?php echo $total_pages;?></label>
                <a <?php if($page >= $total_pages){ echo "disabled";} $next = ($page+1);?> onclick="halaman(<?php echo $next; ?>)" class="btn"> > </a>
            </div>    
    </div>
    </div>

			<?php else: ?>

			<div class="row">

				<div class="col-md-12">

					<div class="well well-lg">

						Tidak ada hasil.

					</div>

				</div>

			</div>

			<?php endif; ?>
<script type="text/javascript">
function halaman(e){
    var produk =  $("#produk").val();
    var urut =  $("#urut").val();
    var kategori = $("#kategori").val();
     $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencariandiUkm/',
           data: "idtoko="+<?php echo $idukm;?>+"&page_number="+e+"&produk="+produk+"&urut="+urut+"&kategori="+kategori,
            success: function(data){
                //caribackup( $("#min").val(),$("#max").val(),$("#produk").val(),$("#urut").val(),$("#kategori").val(),$("#provinsi").val(),$("#kota").val());
                 $("#result").html(data);
             }
         });
}
</script>