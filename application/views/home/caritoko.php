<?php if($tampill): ?>
		<div class="row">	
						<?php foreach($tampill as $tampil):?>
						<div class="col-md-2 col-xs-6">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center productinfo-puji">
											<?php if($tampil->FT_PROFIL != ''): ?>
												<div class="img-ukm">
													<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$tampil->NM_TOKO);?>">												
													<img src="<?php echo base_url();?>upload/profil/<?php echo $tampil->FT_PROFIL;?>" style="height:100px;width:100%">
													</a>
												</div>
											<?php else: ?>
												<div class="img-ukm">
													<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$tampil->NM_TOKO);?>">
														
														<img src="<?php echo base_url();?>assets/images/home/store-icon.png" style="height:100px;width:100%">
													</a>
												</div>
											<?php endif; ?>
											<h2><?php echo $tampil->NM_TOKO;?></h2>
												<a class="btn btn-default add-to-cart" href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$tampil->NM_TOKO);?>">Selengkapnya</a>
										</div>
										
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						
						
		</div>
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
		Tidak ada data...
		<?php endif;?>
<script type="text/javascript">
function halaman(e){
     var namatoko =  $("#namatoko").val();
	  var provinsi = $("#provinsi").val();
	  var kota = $("#kota").val();
     $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>Home_controller/caritoko/',
            data: "page_number="+e+"&namatoko="+namatoko+"&provinsi="+provinsi+"&kota="+kota,
            success: function(data){
                //caribackup( $("#min").val(),$("#max").val(),$("#produk").val(),$("#urut").val(),$("#kategori").val(),$("#provinsi").val(),$("#kota").val());
                 $("#result").html(data);
             }
         });
}
</script>