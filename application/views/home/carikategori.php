 <?php 

            	if($tampill):

            	$c = 0;

            ?>

	        <?php 

	        	foreach($tampill as $row):

	        	$c++;

	        ?>

	        <?php if(($c % 6) == 1) echo '<div class="product-grid-holder">'; ?>

	        <?php $link = setPermalink($row->ID_PRODUK,$row->NM_PRODUK);?>

            <div class="col-sm-4 col-md-2  no-margin product-item-holder">
                <div class="product-item">
						<div class="image">
							<a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>">
							<?php foreach($this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE,1) as $row_gambar):?>
                				<img height="120px;" src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>" alt="" />
                			<?php endforeach; ?>
                			</a>
						</div>
						<div class="body">
							<div class="title">
								<a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>"><?=$row->NM_PRODUK?></a>
							</div>

						</div>
							<div class="row-btn" style="text-align: center">
								<?php if($this->session->userdata('id_akun_user')): ?>
								<a href="#myModal" class="btn btn-puji btn-success" onclick="beli(<?php echo $row->ID_PRODUK ?>)" data-toggle="modal" data-target="#myModal">Beli</a>
								<?php else: ?>
								<a href="<?php echo base_url("login"); ?>" class="btn btn-puji btn-success">Beli</a>
								<?php endif; ?>
							</div>
						<div class="prices">
							<div class="price-current text-center"><?php $h_grosir = explode("|",$row->HARGA);$hh_grosir = explode("-",$h_grosir[0]);if($row->STS_GROSIR == 0):echo formatRp($row->HARGA);else: echo formatRp($hh_grosir[2]); endif;?></div>
						</div>

					</div>
            </div>


			<?php

				if(($c % 6) == 0) echo '</div>';

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
     var min =  $("#min").val();
     var max =  $("#max").val();
    var produk =  $("#produk").val();
    var urut =  $("#urut").val();
    var kategori = $("#kategori").val();
    var provinsi = $("#provinsi").val();
     var kota = $("#kota").val();
     $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/pencarianLihat_produk/',
            data: "page_number="+e+"&min="+min+"&max="+max+"&produk="+produk+"&urut="+urut+"&kategori="+kategori+"&provinsi="+provinsi+"&kota="+kota,
            success: function(data){
                //caribackup( $("#min").val(),$("#max").val(),$("#produk").val(),$("#urut").val(),$("#kategori").val(),$("#provinsi").val(),$("#kota").val());
                 $("#result").html(data);
             }
         });
}
</script>