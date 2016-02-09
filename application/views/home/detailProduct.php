<?php $link = site_url('assets/loading.gif'); ?>
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

		.product-item-holder{
		  height: 370px !important;
		}

		.img-detail-product{
		  width: 100%;
		}
</style>
<div class="loader"></div>
<div class="container">
	<div class="row">

<!--<div class="no-margin col-md-3 gallery-holder">
<input type="hidden" name="id_produk" id="id_produk" value="<?php echo $id_produk; ?>">
<?php foreach ($tampil as $row):?>
<div class="product-item-holder size-big single-product-gallery small-gallery">
		<?php
			$row_gambar = $this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = TRUE);
		?>
        <div id="owl-single-product">
            <div class="single-product-gallery-item" id="slide1">
                <a data-rel="prettyphoto" class="fancybox" href="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>">
                    <img class="img-responsive" alt="" src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>" data-echo="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>" />
                </a>
                
            </div>
        </div>


        <div class="single-product-gallery-thumbs gallery-thumbs">
            <div id="owl-single-product-thumbnails">
            	<?php 
            	$a = 0;
            	foreach($this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE) as $row_gambar): ?>
                <a class="horizontal-thumb <?php if($a == 0) echo 'active' ?>" data-target="#owl-single-product" data-slide="<?php echo $a; ?>" href="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>">
                    <img width="67" alt="" src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>" data-echo="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/none.jpg";endif;?>" />
                </a>         
                <?php 

                $a++;endforeach; ?>       
            </div>

            <div class="nav-holder left hidden-xs">
                <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
            </div>
            
            <div class="nav-holder right hidden-xs">
                <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
            </div>

        </div>
</div>
<?php endforeach; ?>

	
</div>  -->
<div class="no-margin col-md-3 gallery-holder">

<input type="hidden" name="id_produk" id="id_produk" value="<?php echo $id_produk; ?>">


    <div class="product-item-holder size-big single-product-gallery small-gallery">




        <div id="owl-single-product">
       <?php
       		$a=1;
			$row_gambar = $this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE);
			foreach($row_gambar as $gambar):
		?>
            <div class="single-product-gallery-item" id="slide<?php echo $a;?>">
                <a data-rel="prettyphoto" class="fancybox" href="<?php echo base_url();?>assets-admin/img/produk/<?php echo $gambar->FT_PRODUK;?>">
                    <img class="img-responsive img-detail-product" alt="" src="<?php echo base_url();?>assets-admin/img/produk/<?php echo $gambar->FT_PRODUK;?>" data-echo="<?php echo base_url();?>assets-admin/img/produk/<?php echo $gambar->FT_PRODUK;?>" />
                </a>
            </div>

         <?php
         	$a++;
         	endforeach;
         ?>   
		</div>





        


        <div class="single-product-gallery-thumbs gallery-thumbs" align="center" style="width:300px;">
       
            <div id="owl-single-product-thumbnails" class="thumb-custom">
           
            <?php
            	$b=0;
				$a=1;
				$row_gambar = $this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row->ID_PRODUK),$result = FALSE);
				foreach($row_gambar as $gambar):
			?>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="<?php echo $b;?>" href="#slide<?php echo $a;?>">
                    <img  width="100" alt="" src="<?php echo base_url();?>assets-admin/img/produk/<?php echo $gambar->FT_PRODUK;?>" data-echo="<?php echo base_url();?>assets-admin/img/produk/<?php echo $gambar->FT_PRODUK;?>" />
                </a>

              

             <?php
             	$a++;
             	$b++;
             	endforeach;
             ?>  
    
            </div>

           <!-- <div class="nav-holder left hidden-xs">
                <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
            </div>
            
            <div class="nav-holder right hidden-xs">
                <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
            </div> -->
     
        </div>
	<br/>
    </div>


</div>











<!-- <div class="no-margin col-md-3 gallery-holder">

<input type="hidden" name="id_produk" id="id_produk" value="<?php echo $id_produk; ?>">


    <div class="product-item-holder size-big single-product-gallery small-gallery">




        <div id="owl-single-product">
       
            <div class="single-product-gallery-item" id="slide1">
                <a data-rel="prettyphoto" class="fancybox" href="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3281.jpg">
                    <img class="img-responsive" alt="" src="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3281.jpg" data-echo="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3281.jpg" />
                </a>
            </div>

             <div class="single-product-gallery-item" id="slide2">
                <a data-rel="prettyphoto" class="fancybox" href="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg">
                    <img class="img-responsive" alt="" src="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" data-echo="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" />
                </a>
            </div>

            <div class="single-product-gallery-item" id="slide3">
                <a data-rel="prettyphoto" class="fancybox" href="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg">
                    <img class="img-responsive" alt="" src="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" data-echo="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" />
                </a>
            </div>
        
		</div>





        


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
            

                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide1">
                    <img width="150px" alt="" src="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3281.jpg" data-echo="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3281.jpg" />
                </a>

              	<a class="horizontal-thumb" data-target="#owl-single-product" data-slide="1" href="#slide2">
                    <img width="150px" alt="" src="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" data-echo="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" />
                </a>

                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide3">
                    <img width="150px" alt="" src="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" data-echo="http://dev.aldyindonesia.com/assets-admin/img/produk/IMG_3293.jpg" />
                </a>

              
            </div>

            <div class="nav-holder left hidden-xs">
                <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
            </div>
            
            <div class="nav-holder right hidden-xs">
                <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
            </div>
        </div>

    </div>


</div>
 -->














<div class="col-md-6">
	<h1 style="margin-top: -14px;"><?php echo $row->NM_PRODUK ?></h1>
	<hr/>
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
				<h4>Harga Grosir</h4>
				<hr/>
				<table class="table table-striped">
					<tr align="center">
						<td>s/d</td>
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
	                    echo '<tr align="center"><td>'.$data2[0].' - '.$data2[1].'</td><td>'.formatRp($data2[2]).'</tr></td>';    
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
			<?php if($this->session->userdata("id_akun_user")){ ?>
			<hr>
		<button type="button" onclick="beli()" class="btn btn-success btn-block btn-lg" style="font-size: 30px;" data-toggle="modal" data-target="#myModal">Beli</button>
		<?php }
		else{ ?>
		<a class="btn btn-success btn-block btn-lg" style="font-size: 30px;" href="<?php echo site_url('login'); ?>">Beli</a>
		<?php } ?>
		</div>
	</div>
                    
                    <div class="row">
	<div class="col-md-12">
						<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#review" role="tab" data-toggle="tab"><i class="fa fa-quote-right"></i> Ulasan Pelanggan</a></li>
  </ul>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="review">
	<hr/>
	<?php $akun = $this->session->userdata('id_akun_user');
	$cek_beli = $this->db->query("SELECT * FROM mp_cart WHERE ID_AKUN = '$akun' AND ID_PRODUK = '$id_produk'");
	if ($this->session->userdata('id_akun_user')) : ?>
		<?php if ($cek_beli->num_rows() > 0) : ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="formriview">
						<form method="POST" action="<?=base_url()?>user_review/tambahReview">
						<input type="hidden" name="ID_PRODUK" value="<?=$id_produk;?>"/>
						<input type="hidden" name="NM_PRODUK" value="<?=$row->NM_PRODUK?>"/>
						<div class="form-group">
							<label>Masukkan Ulasan</label>
							<div class="well well-sm">
								Berikan ulasan tentang produk kami agar menjadi lebih baik.
							</div>
							<textarea class="form-control" name="REVIEW"></textarea>
						</div>
						<input type="submit" class="btn btn-primary" value="Tambah Review" />
						
						</form>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="well well-lg">
				Silahkan membeli produk ini terlebih dahulu untuk memberikan ulasan produk ini.
			</div>
		<?php endif; ?>
	<?php else: ?>
	<div class="well well-lg">
		Silahkan <a href="<?php echo base_url('login') ?>">login</a> terlebih dahulu untuk memberikan ulasan produk ini.
	</div>
	<?php endif; ?>
	<div class="comments tamreview">
		<div class="comment-item">
        </div>
    </div>
	</div>
</div>
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
	            foreach ($tampil as $row):
	            foreach($this->producthomemodel->tampilData("mp_toko","*",array("ID_TOKO" => $row->ID_TOKO)) as $row_ukm):
	        ?>
	        <div class="form-group">
	        	<label>Nama Produsen</label>
	        	<p><?php echo $row_ukm->NM_TOKO ?></p>
	        </div>
	        <div class="form-group">
	        	<label>Alamat</label>
	        	<p><?php echo $row_ukm->ALAMAT ?></p>
	        	<p><?= getKabupatenRj($row_ukm->ID_PROVINSI, $row_ukm->ID_KOTA); ?>, <?= getProvinsiRj($row_ukm->ID_PROVINSI); ?></p>
	        </div>
	        <div class="form-group">
	        	<label>No Telp</label>
	        	<p class="telpon-palsu">+62XX XXX XXX XXX</p>
	        	<p class="telpon-asli"><?php echo $row_ukm->NO_TELP ?></p>
	        	<p class="open-telp">tampilkan selengkapnya</p>
	        </div>
	         <?php
	                endforeach;
	            endforeach;
	          ?>
		</div>
		<div class="panel-footer">
			<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo $nama_toko = str_replace(" ","-",$row_ukm->NM_TOKO);?>">Lihat informasi produsen</a>
		</div>
	</div>
	<aside class="sidebar blog-sidebar">
	

<div class="widget">
    <h4>Produk Sejenis</h4>
    <div class="body">
    	<?php $produk_lain = $this->producthomemodel->tampilData("mp_produk","*",array("ID_KATEGORI" => $row->ID_KATEGORI, "ID_TOKO <> " => $row->ID_TOKO,"STS_PUBLISH" => 1),FALSE,4,0,"RAND()");?>
		<?php if($produk_lain): ?>	
        <ul class="recent-post-list">
        	
        	<?php
	            foreach ($produk_lain as $row_prolainukm):
	            $link = setPermalink($row_prolainukm->ID_PRODUK,$row_prolainukm->NM_PRODUK);
	        ?>
            <li class="sidebar-recent-post-item">
                <div class="media">
                    <a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>" class="thumb-holder pull-left">
                    	<?php foreach($this->producthomemodel->tampilData("mp_galeri_pro", "FT_PRODUK", array("id_produk"=>$row_prolainukm->ID_PRODUK),$result = FALSE,1) as $row_gambar):?>
			                <img src="<?php if($row_gambar->FT_PRODUK != ""): echo base_url();?>assets-admin/img/produk/rs.php?ok=<?php echo $row_gambar->FT_PRODUK;else: echo base_url()."assets-admin/img/produk/rs.php?ok=none.jpg";endif;?>" alt="" />
			            <?php endforeach; ?>
                    </a>
                    <div class="media-body">
                        <h5><a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>"><?= $row_prolainukm->NM_PRODUK ?></a></h5>
                        <div class="posted-date"><?= $row_prolainukm->TGL_POS ?></div>
                    </div>
                </div>
            </li>
			<?php endforeach; ?>
            
        </ul>
        <?php else: ?>
			<div class="well well-sm">
				Tidak produk sejenis
			</div>
        <?php endif; ?>
    </div>
</div>
</aside>
</div>

	</div>

<section id="recently-reviewd" class="wow fadeInUp" style="margin-bottom: 80px;">
	<div class="container">
		<?php if($prolainukm): ?>
		<div class="carousel-holder hover">
			
			<div class="title-nav">
				<h2 class="h1">Produk Sejenis Toko <?php echo $row_ukm->NM_TOKO ?></h2>
				<div class="nav-holder">
					<a href="#prev" data-target="#owl-produk-sejenis-ukm" class="slider-prev btn-prev fa fa-angle-left"></a>
					<a href="#next" data-target="#owl-produk-sejenis-ukm" class="slider-next btn-next fa fa-angle-right"></a>
				</div>
			</div>

			<div id="owl-produk-sejenis-ukm" class="owl-carousel product-grid-holder">
				<?php
	            foreach ($prolainukm as $row):
	            $link = setPermalink($row->ID_PRODUK,$row->NM_PRODUK);
	        ?>
				<div style="height: auto !important;" class=" no-margin carousel-item product-item-holder size-small hover small-slide-carousel">
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
							<div class="row-btn">
								<?php if($this->session->userdata('id_akun_user')): ?>
								<a href="#myModal" class="btn btn-puji btn-success" onclick="beli(<?php echo $row->ID_PRODUK ?>)" data-toggle="modal" data-target="#myModal">Beli</a>
								<?php else: ?>
								<a href="<?php echo base_url("login"); ?>" class="btn btn-puji btn-success">Beli</a>
								<?php endif; ?>
							</div>
						<div class="prices">
							<div class="price-current text-center"><?php $h_grosir = explode("|",$row->HARGA);$hh_grosir = explode("-",$h_grosir[0]);if($row->STS_GROSIR == 0):echo formatRp($row->HARGA);else: echo formatRp($hh_grosir[2]); endif;?></div>
						</div>
						
					</div><!-- /.product-item -->
				</div>
				<?php endforeach; ?>
			</div>

		</div>
		<?php else: ?>
		<div class="row">
			<div class="col-md-12">
				<div class="well well-sm">Tidak ada produk sejenis</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>



</div>
<!-- Pembelian -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Beli</h4>
      </div>
      <div class="modal-body">
      		<div class="row">
      			<form action="#" method="POST">
      				<div class="">
	      				<div class="col-xs-12 col-md-12">
		      				<input type="hidden" class="form-control"  id="id_produktext"/>
		      				<table class="table table-bordered">
		      					<tr>
		      						<th>Nama Barang</th>
		      						<th>Jumlah Barang</th>
		      						<th>Harga</th>
		      					</tr>
		      					<tr>
		      						<td>
		      							<p id="nama_barang"></p>
		      						</td>
		      						<td>
		      							<input maxlength="4" type="text" class="form-control" onblur="do_hitung()" id="qty" value="1"  />
		      						</td>
		      						<td>
		      							<span id="harga"></span>
										<input type="hidden" class="form-control"  id="hargatext" />
		      						</td>
		      					</tr>
		      				</table>
	      				</div>
      				</div>
					<div class="col-md-7">
						
					</div>
      			</form>
      		</div>
      		<form action="#" method="POST">
			<div class="panel panel-default">
				<div class="panel-body">
				<?php 
				$akun = $this->session->userdata("id_akun_user");
				$cekalamat = $this->db->query("SELECT * FROM mp_temp_alamat WHERE ID_AKUN='$akun'")->num_rows(); ?>
				<?php if($cekalamat>0)
				{
					$a="";
					$b="style='display:none;'";
				} 
				else
				{
					$b="";
					$a="style='display:none;'";
				}

					?>
				<div <?php echo $a; ?> id="alamatdropdown">
				<div class="form-group">
					<a href="#" onclick="tambahalamat()" class="btn btn-default"><i class="fa fa-plus"></i> Alamat Baru</a>	
				</div>
					<div class="form-group">
						<label>Alamat Pengiriman</label>
						<select name="alamat" onchange="alamat_stts()" id="id_alamat" class="select form-control">
						<?php echo "<option value='0'>---Pilih Alamat---</option>"; ?>
					    <?php foreach ($getalamat as $isi) { ?>
					        <option <?php if($isi->STS==1) echo "selected=''"; ?> value="<?php echo $isi->ID_ALAMAT; ?>"><?php echo $isi->SIMPAN_SEBAGAI." - ".$isi->ALAMAT; ?></option>
					    <?php } ?>
					    </select>
					</div>
					<div class="info-alamat" style="display: none">
					</div>
				</div>

				<div <?php echo $b; ?> id="tambahkanalamat">
					<div class="form-group">
						<a href="#" onclick="kembali()" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
					</div>
					<div class="form-group">
						<label>Simpan Alamat Sebagai</label>
						<input type="text" id="simpansebagai" class="form-control" placeholder="Simpan Sebagai Alamat Rumah / Pacar"/>
					</div>
					<div class="form-group">
						<label>Nama Penerima</label>
						<input type="text" id="nama_penerima" class="form-control" placeholder="Masukan Nama Penerima"/>
					</div>
					<div class="form-group">
						<label>No HP Penerima</label>
						<input type="text" id="no_hp_penerima" class="form-control" placeholder="Masukan No HP Penerima"/>
					</div>
					<div class="form-group">
						<label>Pilih Provinsi</label>
						<select id="id_provinsi" class="form-control" name="id_provinsi">
						    <option>Pilih Provinsi</option>
						    <?php foreach($provinsi->rajaongkir->results as $data_prov): ?>
					        <option value="<?php echo $data_prov->province_id; ?>"><?php echo $data_prov->province; ?></option>
					    	<?php endforeach; ?>
					    </select>
	    				<p class="text-muted" id="sts"></p>
    				</div>
    				<div class="form-group">
						<label>Pilih Kota</label>
					    <select id="id_kota" class="form-control" name="id_kota">
					        <option>Pilih provinsi terlebih dahulu</option>
					    </select>
					</div>
					<div class="form-group">
						<label>Alamat Lengkap</label>
						<textarea id="alamat" class="form-control" placeholder="Masukan Alamat Lengkap"></textarea>
					</div>
					<div class="form-group">
						<label>Kode POS</label>
						<input type="text" id="kode_pos" class="form-control" placeholder="Masukan Kode POS"/>
					</div>
					<div class="form-group">
						<label></label>
					    <a href="#" onclick="do_alamat()" class="btn btn-success">Tambahkan</a>
					</div>
				</div>
					<?php 
					//New
					if($getalamate){
						$h = "";
					}
					else
					{
						$h = "style='display:none'";
					}
					//New
					?>
					<div class="form-group" <?php echo $h; ?> id="kurire">
						<label>Kurir Pengiriman</label>
						<select id="kurir" onchange="do_hitung_uang()" class="form-control" name="kurir">
						<option value="0">---Pilih Kurir---</option>
						    <?php 
						    $tokone = $row->ID_TOKO;
						    $kurir = $this->db->query("SELECT * FROM mp_kurir WHERE ID_TOKO='$tokone'")->row();
						    if($kurir->JNE==1)
						    {
						    ?>
					        <option value="jne">JNE</option>
					        <?php 
					        }
					        if($kurir->TIKI==1)
						    {
						    ?>
					        <option value="tiki">TIKI</option>
					        <?php 
					        }
					        if($kurir->POS==1)
						    {
						    ?>
					        <option value="pos">POS</option>
					        <?php 
					        }
					        ?>
					    	
					    </select>
					</div>
					<div class="form-group">
						<label>Paket Pengiriman</label><br/>
					    <span id="ongkir">-</span>
					</div>
					<div class="form-group">
						<label>Ongkos Kirim</label><br/>
					    <span id="a">-</span>
					    <input type="hidden" id="hargapengiriman">
					</div>
					<div class="form-group">
						<label>Sub Total</label><br>
						<span id="subtotal">Rp 0,-</span>
					    
					</div>
</div>
			</div>
	  </form>
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="tmb" onclick="lanjutkan()" disabled="disabled" >Lanjutkan</button>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Pembelian -->
<script type="text/javascript">
$(".loader").fadeOut();
	var idpro = <?=$id_produk;?>;
	
	// function tomreview () {
		// $.ajax({
			// dataType: "json",
			// type: "POST",
			// url : "site_url('user_review');",
			// data : "id_pro="+idpro,
			// success:function(html){
				// if (html.status == 'yes'){
					// $('.tamreview').empty();
					// for (var i=0; i < html.data.length; i++) {
						// var str = '<div class="comment-item">'+
							  // '<div class="row no-margin">'+
							  // '<div class="col-lg-1 col-xs-12 col-sm-2 no-margin">'+
                              // '<div class="avatar">' +
							  // '<img style="width: 50px;height:50px;" src="echo base_url() assets/images/default-avatar.jpg" alt="avatar">' +
							  // '</div>' +
							  // '</div>' +
							  // '<div class="col-xs-12 col-lg-11 col-sm-10 no-margin">'+
							  // '<div class="comment-body">' +	 
							  // '<div class="meta-info">' +	 
							  // '<div class="author inline">' +	 
							  // html.data[i].NAMA+
							  // '</div>'+
						      // '<p class="comment-text">'+html.data[i].REVIEW+'</p>'+
							  // '</div>'+
							  // '</div>'+
							  // '</div>'+
							  // '</div>';
						// $('.tamreview').append(str);
					// };
				// }
				// else if(html.status == 'no'){
// 					
				// }
			// }
		// })
	// }
	
	$(document).ready(function() {
		$(".fancybox").fancybox();
		var id_alamat = $("#id_alamat").val();
		var str_alamat = $();
		$.ajax({
			type: "POST",
			url : "<?=site_url('Home_controller/getinfoalamat');?>",
			data : "id_alamat="+id_alamat,
			success : function(msg){
				$(".info-alamat").show();
				$(".info-alamat").html(msg);
			}
		});
		$.ajax({
			dataType: "json",
			type: "POST",
			url : "<?=site_url('user_review');?>",
			data : "id_pro="+idpro,
			success:function(html){
				if (html.status == 'yes'){
					$('.tamreview').empty();
					for (var i=0; i < html.data.length; i++) {
						var str = '<div class="comment-item">'+
							  '<div class="row no-margin">'+
							  '<div class="col-lg-1 col-xs-12 col-sm-2 no-margin">'+
                              '<div class="avatar">' +
							  '<img style="width: 50px;height:50px;" src="<?php echo base_url() ?>assets/images/default-avatar.jpg" alt="avatar">' +
							  '</div>' +
							  '</div>' +
							  '<div class="col-xs-12 col-lg-11 col-sm-10 no-margin">'+
							  '<div class="comment-body">' +	 
							  '<div class="meta-info">' +	 
							  '<div class="author inline">' +	 
							  html.data[i].NAMA+
							  '</div>'+
						      '<p class="comment-text">'+html.data[i].REVIEW+'</p>'+
							  '</div>'+
							  '</div>'+
							  '</div>'+
							  '</div>';
						$('.tamreview').append(str);
					};
				}
				else if(html.status == 'no'){
					
				}
			}
		});
		$("#id_alamat").change(function(){
			var id_alamat = $("#id_alamat").val();
			var str_alamat = $();
			$.ajax({
				type: "POST",
				url : "<?=site_url('Home_controller/getinfoalamat');?>",
				data : "id_alamat="+id_alamat,
				success : function(msg){
					$(".info-alamat").show();
					$(".info-alamat").html(msg);
				}
			})
		})
	});
	function beli()
	{
		 $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/modal'); ?>",
            cache :false,
            dataType: "json",
            data: "id_produk=" + $('#id_produk').val(),
            success : function(msg) {
            	$("#nama_barang").html(msg['NM_PRODUK']).show();
            	$("#id_produktext").val(msg['ID_PRODUK']);

            	if(msg['STS_GROSIR']==1)
            	{
            		var harga = msg['HARGA'];
            		var res = harga.split("|");
            		var ke2 = res[0].split("-");
            		formatHarga(ke2[2]);
            		//$("#harga").html(ke2[2]).show();
            	}
            	else
            	{
            		formatHarga(msg['HARGA']);
            		//$("#harga").html(msg['HARGA']).show();
            	}
            	
            	$("#hargatext").val(msg['HARGA']);
            	$('#myModal').modal('show');
            },
            error : function() {
                
            }
        });
    	return false;
	}
	function order() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/to_cart'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produk').val()+ "&qty=" + $('#qty').val(),
            success : function(msg) {
            	if(msg==1)
            	{
            		//alert("Add to Cart Success.");
            	}
            	else if (msg==2)
            	{
            		//alert("Update to Cart Success.");
            	}
            	else
            	{
            		//alert("Do Not Input 0.");
            	}
            	hitung();
            },
            error : function() {
                
            }
        });
    return false;
    }
     $("#qty").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
     function do_hitung()
     {
     	if($("#qty").val()!=0)
     	{
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/hitungqty'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produk').val()+ "&qty=" + $('#qty').val(),
            success : function(msg) {
            	$("#hargatext").val(msg);
            	$("#harga").html(msg).show();
            	if($("#ong").val())
            	{
            		if($("#ong").val()!=0)
            		{
            		do_hitung_uange();
            		}
            	}
            },
            error : function() {
                
            }
        });
    	return false;
    	}
    	else
    	{
    		if($("#qty").val())
    		{
				$('#qty').val(1);
    		}
    		else
    		{
    			$('#qty').val(1);
    		}
	    	$.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('user_cart/hitungqty'); ?>",
	            cache :false,
	            data: "id_produk=" + $('#id_produktext').val()+ "&qty=" + $('#qty').val(),
	            success : function(msg) {
	            	$("#hargatext").val(msg);
	            	$("#harga").html(msg).show();
	            	if($("#ong").val())
	            	{
	            		if($("#ong").val()!=0)
	            		{
	            		do_hitung_uange();
	            		}
	            	}
	            },
	            error : function() {
	                
	            }
	        });
	    	return false;
    	}
     }
     function do_hitung_uang()
     {
     	$(".loader").fadeIn();
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_hitung_uang'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produk').val()+ "&qty=" + $('#qty').val()+ "&kurir=" + $('#kurir').val()+ "&id_alamat=" + $('#id_alamat').val(),
            success : function(msg) {
            	$("#ongkir").html(msg).show();
            	$("#a").html("-").show();
            	if($("#kurir").val()==0)
            	{
            		$('#tmb').prop("disabled", true);	
            	}
            	$(".loader").fadeOut();
            },
            error : function() {
                $(".loader").fadeOut();
            }
        });
    	return false;
     }
     function do_hitung_uange()
     {
     	$(".loader").fadeIn();
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_hitung_uange'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produk').val()+ "&qty=" + $('#qty').val()+ "&kurir=" + $('#kurir').val()+ "&id_alamat=" + $('#id_alamat').val()+ "&ong=" + $('#ong').val(),
            success : function(msg) {
            	var fo = formatRupiah(msg);
            	var result = msg.split('#');
            	$("#hargapengiriman").val(result[0]);
            	do_hitung_all();
            	if($("#ong").val()!=0)
            	{
            		$('#tmb').prop("disabled", false);	
            	}
            	else
            	{
            		$('#tmb').prop("disabled", true);	
            	}
            	$(".loader").fadeOut();
            },
            error : function() {
                $(".loader").fadeOut();
            }
        });
    	return false;
     }
     function do_hitung_all()
     {
     	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_hitung_all'); ?>",
            cache :false,
            data: "id_produk=" + $('#id_produk').val()+ "&qty=" + $('#qty').val()+ "&hargapengiriman=" + $('#hargapengiriman').val(),
            success : function(msg) {
            	$("#subtotal").html(msg).show();
            },
            error : function() {
                
            }
        });
    	return false;
     }
     function tambahalamat()
     {
     	$("#alamatdropdown").hide();
     	$("#tambahkanalamat").show();
     	$("#simpansebagai").val('');
     	$("#alamat").val('');
     	$("#nama_penerima").val('');
     	$("#no_hp_penerima").val('');
     	$("#kode_pos").val('');
     	$("#id_provinsi").val('');
     	$("#id_kota").val('');
     }
     function kembali()
     {
     	$("#alamatdropdown").show();
     	$("#tambahkanalamat").hide();
     }
     $("#id_provinsi").change(function(){
        var id_provinsi = $("#id_provinsi").val();
        $("#sts").html('Loading kota...');
        $.ajax({
            url: "<?php echo base_url('user_cart/getKota') ?>",
            type : "POST",
            data: "id_provinsi=" + id_provinsi,
            cache: false,
            success: function(msg){
                 $("#sts").html('');
                $("#id_kota").html(msg);
            }
        });
    });
     function do_alamat() {
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/do_alamat'); ?>",
            cache :false,
            data: "alamat="+$("#alamat").val()+"&simpansebagai="+$("#simpansebagai").val()+"&nama_penerima="+$("#nama_penerima").val()+"&no_hp_penerima="+$("#no_hp_penerima").val()+"&kode_pos="+$("#kode_pos").val()+"&id_provinsi="+$("#id_provinsi").val()+"&id_kota="+$("#id_kota").val(),
            success : function(msg) {
            	kembali();
                	$.ajax( {
			            type :"POST",
			            url :"<?php echo site_url('user_cart/isidropdown'); ?>",
			            cache :false,
			            success : function(msg) {
			            	$("#id_alamat").html(msg);
			            },
			            error : function() {
			                
			            }
			        });
			    	return false;

            },
            error : function() {
                
            }
        });
        return false;
    }
    function alamat_stts() {
    	var a=$("#id_alamat").val();
    	if($("#id_alamat").val()!=0)
    	{
    			$('#kurire').show();
    			$('#ongkir').show();
    			$('#a').show();
    			$('#subtotal').show();
	    		$.ajax( {
	            type :"POST",
	            url :"<?php echo site_url('user_cart/alamat_stts'); ?>",
	            cache :false,
	            data: "id_alamat="+$("#id_alamat").val(),
	            success : function(msg) {
	                if($("#id_alamat").val()==0)
	                {
	                	$('#tmb').prop("disabled", true);	
	                }
	                else
	                {
	                	$("#kurir").val(0);
	                	$("#ong").val(0);
	                	$("#a").html("").show();
	                	$("#hargapengiriman").val(0);
	                	$("#subtotal").html("Rp 0,-").show();
	                	$('#tmb').prop("disabled", true);	
	                }
	            },
	            error : function() {
	                
	            }
	        });
	        return false;
    	}
    	else
    	{
    		$('#kurire').hide();
    		$('#ongkir').hide();
    		$('#a').hide();
    		$('#subtotal').hide();
    		$('#tmb').prop("disabled", true);	
    	}
        
    }
    function lanjutkan() {
    	$(".loader").fadeIn();
        $.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/to_cart'); ?>",
            cache :false,
            data: "id_produktext="+$("#id_produktext").val()+"&qty="+$("#qty").val()+"&id_alamat="+$("#id_alamat").val()+"&kurir="+$("#kurir").val()+"&ong="+$("#ong").val()+"&hargapengiriman="+$("#hargapengiriman").val(),
            success : function(msg) {
            	//alert(msg);
                if(msg==1)
            	{
            		//alert("Sukses menambah ke keranjang belanja.");
            	}
            	else if (msg==2)
            	{
            		//alert("Keranjang berhasil diperbaharui.");
            	}
            	else
            	{
            		alert("Do Not Input 0.");
            	}
            	$("#myModal").modal("hide");
            	$(".loader").fadeOut();
            	location.reload();
            },
            error : function() {
                
            }
        });
        return false;
    }
    function formatRupiah(nominal)
    {
    	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/formatRupiah'); ?>",
            cache :false,
            data: "nominal="+nominal,
            success : function(msg) {
                $("#a").html(msg).show();
            },
            error : function() {
                
            }
        });
        return false;
    }
    function formatHarga(nominal)
    {
    	$.ajax( {
            type :"POST",
            url :"<?php echo site_url('user_cart/formatHarga'); ?>",
            cache :false,
            data: "nominal="+nominal,
            success : function(msg) {
                $("#harga").html(msg).show();
            },
            error : function() {
                
            }
        });
        return false;
    }
</script>