<?php
if($this->session->userdata('id_akun_user') or $this->session->userdata('id_akun_ukm')){
	$function = 'onload="myFunction()"';
}
else{
	$function ='';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="<?=@$meta->DES_META?>">
    <meta name="keyword" content="<?=@$meta->KEY_META?>">
    <meta name="author" content="">
    <meta name="robots" content="all">
    <title>INDOBABA | Tokonya UKM</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">
    <link href="<?php echo base_url() ?>assets/css/orange.css" rel="stylesheet">
		
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owl.carousel.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owl.transitions.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.min.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
	
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/icon.png">
 	
 	<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
 	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fancy/source/jquery.fancybox.css" type="text/css" media="screen" />
	<script  src="<?php echo base_url() ?>assets/fancy/source/jquery.fancybox.pack.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=@$meta->DES_META?>">
    <meta name="keyword" content="<?=@$meta->KEY_META?>">
    <meta name="author" content="">
    </head>
<body <?php echo $function ?>>
<div class="wrapper">
	
		<!-- ============================================================= TOP NAVIGATION ============================================================= -->
<nav class="top-bar animate-dropdown">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul>
               <?php 
								$ta = $this->db->query('SELECT * FROM mp_halaman WHERE STATUS=1')->result();
								foreach ($ta as $as) { 
								?>
								<li><a href="<?=base_url('page/'.$as->LINK); ?>"><?php echo $as->NAMA_MENU; ?></a></li>
								<?php } ?>	
             </ul>
        </div><!-- /.col -->

        <div class="col-xs-12 col-sm-6 no-margin">
            <ul class="right">
              <?php 
								$akun = $this->session->userdata("id_akun_user");
								$query=$this->db->query("SELECT COUNT(ID_CART) AS TOTAL FROM mp_temp_cart WHERE ID_AKUN='$akun' ")->row(); 
								if($this->session->userdata("id_akun_user"))
								{ ?>
								<li><a href="<?=base_url('user_profil'); ?>"><i class="fa fa-user"></i> Profil Saya</a></li>
								<li><a href="<?=base_url('user_checkout/checkout'); ?>"><i class="fa fa-list"></i> Tagihan Saya</a></li>
								<?php }else{ ?>
								<li><a href="<?=base_url('user_register')?>"><i class="fa fa-user"></i> Daftar</a></li>
								<li><a href="<?=base_url('login')?>"><i class="fa fa-lock"></i> Masuk</a></li>
								<?php } ?>
								<?php if($this->session->userdata('id_akun_user')): ?>
								<li><a href="<?=base_url('login/logout_user')?>"><i class="fa fa-lock"></i> Keluar</a></li>
								<?php endif; ?>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.container -->
</nav><!-- /.top-bar -->
<header>
	<div class="container no-padding">
		
		<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
			<!-- ============================================================= LOGO ============================================================= -->
<div class="logo">
	<a href="<?php echo site_url(''); ?>">
		<img alt="logo" src="<?php echo base_url('assets/images/home/logo.png'); ?>" width="233" />
	</a>
</div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

		<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
			<div class="contact-row">
    <div class="phone inline">
        <i class="fa fa-phone"></i> 0811 888 500
    </div>
    <div class="contact inline">
        <i class="fa fa-home"></i> <span class="le-color">Jl. Simpang Wilis Indah No 1 Kota Malang, Jawa Timur</span>
    </div>
</div><!-- /.contact-row -->
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form action ="<?php echo base_url();?>home_controller/cari" method="POST">
        <div class="control-group">
            <input class="search-field" placeholder="Cari Produk Disini" name="produk"/>
            <input type="submit" class="search-button" value="Cari"/>
        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

		<div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
			<div class="top-cart-row-container">
    

    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
    <?php if($this->session->userdata('id_akun_user')): ?>
    <div class="top-cart-holder dropdown animate-dropdown">
        
        <div class="basket">
            
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div class="basket-item-count">
                <?php
                 $sir = $this->session->userdata("id_akun_user");
                 $as = $this->db->query("SELECT * FROM view_temp_cart  WHERE ID_AKUN = '$sir'")->result();
                ?>
                    <span class="count"><?php if($as) echo count($as);  else echo 0;?></span>
                    <img src="<?php echo base_url() ?>assets/images/icon-cart.png" alt="" />
                </div>
                <div class="total-price-basket"> 
                    <span class="lbl">Keranjang:</span>
                    <span class="total-price">
                        <span class="sign"></span><span class="value"><?php 
                       
                        $total=0;
                        foreach ($as as $aa) {
                            $total += $aa->HARGA*$aa->QTY;
                        }
                        echo formatRp($total); ?></span>
                    </span>
                </div>
            </a>

            <ul id="tampilkan" class="dropdown-menu">
            <?php 
            if($akun){
                    if($as)
                    {
                    foreach ($as as $key) { 
                    ?>
                    <li>
                    <div class="basket-item">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 no-margin text-center">
                                    <div class="thumb">
                                    <?php $g = $this->db->query("SELECT * FROM mp_galeri_pro  WHERE ID_PRODUK = '$key->ID_PRODUK' limit 1")->row(); ?>
                                        <img alt="" width="100" src="<?php echo site_url('assets-admin/img/produk/rs.php?ok='.$g->FT_PRODUK); ?>" />
                                    </div>
                                </div>
                                <div class="col-xs-8 col-sm-8 no-margin keranjang-puji">
                                    <div class="title"><?php echo $key->NM_PRODUK; ?></div>
                                    <div class="price"><?php echo formatRp($key->HARGA); ?></div>
                                    <div class="price"><?php echo $key->QTY; ?> Buah</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php 
                        }
                    } 
                    ?>
                     <li>
                    <div class="basket-item">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 no-margin text-center">
                                    <div class="thumb">
                                    </div>
                                </div>
                                <div class="col-xs-8 col-sm-8 no-margin">
                                    <div class="title"><a href="<?php echo site_url('cart'); ?>">Tampilkan Semua</a></div>
                                </div>
                            </div>
                        </div>
                    </li>
            <?php } ?>
            </ul>
        </div><!-- /.basket -->



    </div>
	<?php endif; ?>
</div><!-- /.top-cart-row-container -->
<!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div><!-- /.top-cart-row -->

	</div><!-- /.container -->
</header>
<!-- ============================================================= HEADER : END ============================================================= -->		<div id="top-banner-and-menu">
	
</div>

<?php $this->load->view($page); ?>
<footer id="footer" class="color-bg">
    
    <div class="container">
        <div class="row no-margin widgets-row">
            <div class="col-xs-12  col-sm-4 no-margin-left">
                <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
<div class="widget">
    <h2>Banyak Dilihat</h2>
    <div class="body">
        <ul>
        	<?php 
			$banyaklht = $this->db->query('SELECT * FROM mp_produk ORDER BY HITS DESC LIMIT 3')->result();
			foreach ($banyaklht as $lht) :
			$link = setPermalink($lht->ID_PRODUK,$lht->NM_PRODUK);?>
            <li>
                <div class="row">
					<div class="col-xs-12 col-sm-9 no-margin">
						<a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>"><?=$lht->NM_PRODUK?></a>
					</div>
					<div class="col-xs-12 col-sm-3 no-margin">
						<a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>" class="thumb-holder">
							<?php 
							$ftnewpro = $this->db->query('SELECT * FROM mp_galeri_pro WHERE ID_PRODUK = "'.$lht->ID_PRODUK.'" ORDER BY RAND()')->row();
							?>	
							<img alt="" src="<?php echo base_url().'assets-admin/img/produk/rs.php?ok='.$ftnewpro->FT_PRODUK ?>"/>
						</a>
					</div>
				</div>
            </li>
            <?php endforeach;?>
        </ul>
    </div><!-- /.body -->
</div> <!-- /.widget -->
<!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->            </div>

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
<div class="widget">
    <h2>Toko Terbaru</h2>
    <div class="body">
        <ul>
			<?php 
			$newtk = $this->db->query('SELECT * FROM mp_toko ORDER BY ID_TOKO DESC LIMIT 3')->result();
			foreach ($newtk as $tk) :
			?>	
			<li>
				<div class="row">
					<div class="col-xs-12 col-sm-9 no-margin">
						<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo str_replace(" ","-",$tk->NM_TOKO);?>"><?=$tk->NM_TOKO?></a>
					</div>  
					<div class="col-xs-12 col-sm-3 no-margin">
						<a href="<?php echo base_url()?>Home_controller/ukm/<?php echo str_replace(" ","-",$tk->NM_TOKO);?>" class="thumb-holder">
							<?php if(!empty($tk->FT_PROFIL)) :?>
							<img alt="" src="<?php echo base_url().'upload/profil/'.$tk->FT_PROFIL ?>" />
							<?php else :?>
							<img alt="" src="<?php echo base_url().'assets/images/home/store-icon.png'?>" />
							<?php endif;?>
						</a>
					</div>
				</div>
			</li>
			<?php endforeach;?>
        </ul>
    </div><!-- /.body -->
</div> <!-- /.widget -->
<!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->            </div>

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
<div class="widget">
    <h2>Produk Terbaru</h2>
    <div class="body">
        <ul>
			<?php 
			$newpro = $this->db->query('SELECT * FROM mp_produk ORDER BY ID_PRODUK DESC LIMIT 3')->result();
			foreach ($newpro as $pr) :
			$link = setPermalink($pr->ID_PRODUK,$pr->NM_PRODUK);?>
			<li>
				<div class="row">
					<div class="col-xs-12 col-sm-9 no-margin">
						<a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>"><?=$pr->NM_PRODUK?></a>
					</div>
					<div class="col-xs-12 col-sm-3 no-margin">
						<a href="<?=base_url()?>Home_controller/detailProduct/<?=$link?>" class="thumb-holder">
							<?php 
							$ftnewpro = $this->db->query('SELECT * FROM mp_galeri_pro WHERE ID_PRODUK = "'.$pr->ID_PRODUK.'" ORDER BY RAND()')->row();
							?>	
							<img alt="" src="<?php echo base_url().'assets-admin/img/produk/rs.php?ok='.$ftnewpro->FT_PRODUK ?>"/>
						</a>
					</div>
				</div>
			</li>
			<?php endforeach;?>
        </ul>
    </div>
</div>
        </div>
        </div><!-- /.widgets-row-->
    </div><!-- /.container -->


    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
<div class="contact-info">
    Management by :<br>
    <div class="footer-logo">
        <img alt="logo" src="http://dev.aldyindonesia.com/assets/images/home/logo.png" width="233">   
    </div><!-- /.footer-logo -->
    <div class="row">
    <div class="col-md-3">
    	<img src="http://dev.aldyindonesia.com/assets/images/home/logokoperasi.png" width="75">
    </div>
    <div class="col-md-9">
    	    <font size="2px"> KOPERASI SERBA USAHA</font>
    		<br>
    		<p class="regular-bold"><font size="4px">DAYA GUNA MANDIRI</font>
    		<br>
			<font size="1px">BH NO. 225/BH/KDK.13.32/1.2/VII/1999</font>
    		</p>
   
    </div>
    </div>
    
    

    <p>
        Jalan Simpang Wilis Indah No 1 Malang, Jawa Timur
        <br>
        Telp : 0341 580 500
    </p>

</div>
<!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->
<div class="link-widget">
    <div class="widget">
        <h3>Find it fast</h3>
        <ul>
            <li><a href="category-grid.html">laptops &amp; computers</a></li>
            <li><a href="category-grid.html">Cameras &amp; Photography</a></li>
            <li><a href="category-grid.html">Smart Phones &amp; Tablets</a></li>
            <li><a href="category-grid.html">Video Games &amp; Consoles</a></li>
            <li><a href="category-grid.html">TV &amp; Audio</a></li>
            <li><a href="category-grid.html">Gadgets</a></li>
            <li><a href="category-grid.html">Car Electronic &amp; GPS</a></li>
            <li><a href="category-grid.html">Accesories</a></li>
        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->

<div class="link-widget">
    <div class="widget">
        <h3>Information</h3>
        <ul>
            <li><a href="category-grid.html">Find a Store</a></li>
            <li><a href="category-grid.html">About Us</a></li>
            <li><a href="category-grid.html">Contact Us</a></li>
            <li><a href="category-grid.html">Weekly Deals</a></li>
            <li><a href="category-grid.html">Gift Cards</a></li>
            <li><a href="category-grid.html">Recycling Program</a></li>
            <li><a href="category-grid.html">Community</a></li>
            <li><a href="category-grid.html">Careers</a></li>

        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->

<div class="link-widget">
    <div class="widget">
        <h3>Information</h3>
        <ul>
            <li><a href="category-grid.html">My Account</a></li>
            <li><a href="category-grid.html">Order Tracking</a></li>
            <li><a href="category-grid.html">Wish List</a></li>
            <li><a href="category-grid.html">Customer Service</a></li>
            <li><a href="category-grid.html">Returns / Exchange</a></li>
            <li><a href="category-grid.html">FAQs</a></li>
            <li><a href="category-grid.html">Product Support</a></li>
            <li><a href="category-grid.html">Extended Service Plans</a></li>
        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->
<!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    © <a href="index.html">Indobaba Group</a> - all rights reserved
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <!--<div class="payment-methods ">
                    <ul>
                        <li><img alt="" src="assets/images/payments/payment-visa.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-master.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-paypal.png"></li>
                        <li><img alt="" src="assets/images/payments/payment-skrill.png"></li>
                    </ul>
                </div> /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer>
</div>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/owl.carousel.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/css_browser_selector.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/echo.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.easing-1.3.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap-slider.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.raty.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.prettyPhoto.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.customSelect.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/wow.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/scripts.js"></script>

</body>
</html>