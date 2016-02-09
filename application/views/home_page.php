<?php
$tampilkategori = $this->db->query('select * from mp_kategori')->result();
$widget_1 = $this->db->query('select * from view_widget WHERE TYPE="1"')->result();
$widget_2 = $this->db->query('select * from view_widget WHERE TYPE="2"')->result();
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
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.min.css">
	
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
              <?php 			$akun = $this->session->userdata("id_akun_user");
								$query=$this->db->query("SELECT COUNT(ID_CART) AS TOTAL FROM mp_temp_cart WHERE ID_AKUN='$akun' ")->row(); 
								if($this->session->userdata("id_akun_user"))
								{
									$auth = $this->session->userdata("id_akun_auth");
									$nama = $this->db->query("SELECT * from mp_akun WHERE ID_AKUN='$auth'")->row();
								?>
								<li><a href="<?=base_url('user_profil'); ?>"><i class="fa fa-user"></i> Hai, <?php echo $nama->NAMA ?></a></li>
								<li><a href="<?=base_url('user_checkout/checkout'); ?>"><i class="fa fa-list"></i> Transaksi Saya</a></li>
								<li><a href="<?=base_url('user_riwayat_saldo'); ?>"><i class="fa fa-money"></i> Saldo : <?php echo formatRp($nama->SALDO)?></a></li>
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
		<img class="responsive-logo" alt="logo" src="<?php echo base_url('assets/images/home/logo.png'); ?>" width="233" />
	</a>
</div><!-- /.logo -->
<!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

		<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
<!-- ============================================================= SEARCH AREA ============================================================= -->
<div class="search-area">
    <form action ="<?php echo base_url();?>home_controller/cari" method="POST">
        <div class="control-group">
            <input class="search-field" placeholder="Cari Produk Disini" name="produk"/>
                <select class="kategoricombobox" name="statusyangadadipencarianbesar">
                  <option value="Produk">Produk</option>
                  <option value="toko">Toko</option>
                  
                </select>
            <input type="submit" class="search-button" value="Cari"/>
            <!--<div class="icon-cari">
                <i class="fa fa-search"></i>
            </div>-->
        </div>
    </form>
</div><!-- /.search-area -->
<!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

		<div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
			<div class="top-cart-row-container" style="text-align: center;">
    

    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
    <?php if($this->session->userdata('id_akun_user')): ?>
    <div class="top-cart-holder dropdown animate-dropdown">
        
        <div class="basket">
            
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <div class="basket-item-count">
                <?php
                 $sir = $this->session->userdata("id_akun_user");
                 $asJ = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$sir'")->result();
                 $as = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$sir' GROUP BY ID_PRODUK")->result();
                 $toko = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$sir' GROUP BY ID_TOKO")->result();
                ?>
                    <span class="count"><?php if($asJ) echo count($asJ);  else echo 0;?></span>
                    <img src="<?php echo base_url() ?>assets/images/icon-cart.png" alt="" />
                </div>
                <div class="total-price-basket"> 
                    <span class="lbl">Keranjang:</span>
                    <span class="total-price">
                        <span class="sign"></span><span class="value"><?php 
                        $k = 0;
                        foreach ($toko as $tk) {
                        	$m = 0;
                        	$alamat = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$sir' AND ID_TOKO = '$tk->ID_TOKO' GROUP BY ID_ALAMAT")->result();
							foreach ($alamat as $al){
								$kurir = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$sir' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' GROUP BY ID_ONGKIR")->result();
								foreach ($kurir as $kr){
									$i = 0;
									$pro = $this->db->query("SELECT * FROM view_temp_checkout WHERE ID_AKUN = '$sir' AND ID_TOKO = '$tk->ID_TOKO' AND ID_ALAMAT = '$al->ID_ALAMAT' AND ID_ONGKIR = '$kr->ID_ONGKIR'")->result();
									foreach ($pro as $pr){
										$pro_harga[$i] = ($pr->QTY * $pr->HARGA_SATUAN);
										$i++;
									}
									for ($n=0; $n < $i; $n++) {
										$pro_harga[$n] += @$pro_harga[$n-1];
									}
									$tot_harga[$m] = $pro_harga[$n-1] + $kr->TOTAL;
									$m++;
								}
							}
							for ($j=0; $j < $m; $j++){
								$tot_harga[$j] += @$tot_harga[$j-1];
							}
							$tot_tag[$k] = @$tot_harga[$j-1];
							$k++;
                        }
						for ($l=0; $l < $k; $l++){
							$tot_tag[$l] += @$tot_tag[$l-1];
						}
                        echo formatRp(@$tot_tag[$l-1]); ?></span>
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
                    <div class="">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 no-margin">
                                    <div class="title"><a class="btn-tampilkan" href="<?php echo site_url('cart'); ?>">Tampilkan Semua</a></div>
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
    <!-- NAVBAR CATEGORIES -->
        <nav class="navbar navbar-default navbar-puji" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                    	<?php foreach($tampilkategori as $row):
							$string = "";
							$string = str_replace(" ","-",$row->KATEGORI);
						?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $row->KATEGORI;?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            	<?php foreach($this->db->query('select * from mp_sub_kategori WHERE ID_KATEGORI="'.$row->ID_KATEGORI.'"')->result() as $row_sub):?>
                                <li><?php $link = setPermalink($row_sub->ID_SUB_KATEGORI,$row_sub->SUB_KATEGORI);echo anchor("home_controller/kategori/$link",$row_sub->SUB_KATEGORI);?></li>
                            	<?php endforeach; ?>
                            	
                            </ul>
                        </li>
						<?php endforeach; ?>
						<li><a href="<?php echo base_url('home_controller/halamanSemuakategori') ?>">Semua Kategori</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
<!-- ============================================================= HEADER : END ============================================================= -->		<div id="top-banner-and-menu" >
	
</div>

<?php $this->load->view($page); ?>
<footer id="footer" class="color-bg">
    <div class="link-list-row" style="margin-top:30px;margin-bottom:30px">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
<div class="contact-info">
   
    <div class="footer-logo">
    <img alt="logo" src="http://dev.aldyindonesia.com/assets/images/home/logo.png" width="233">   
    </div><!-- /.footer-logo -->
    <br/>
    Management by :
    <br/><br/>
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
        Telp : +62341 580 500
    </p>

</div>
<!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

            <div class="col-xs-12 col-md-8 no-margin footer-center">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->
<div class="link-widget">
    <div class="widget">
        <h3>Kategori Produk</h3>
        <ul>
            <li><a href="category-grid.html">Aksesoris</a></li>
            <li><a href="category-grid.html">Makanan</a></li>
          
        </ul>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->

<div class="link-widget">
    <div class="widget">
        <h3>Belanja di Indobaba</h3>
        <?php if($widget_2): ?>
			<ul>
			<?php foreach($widget_2 as $data_widget_2): ?>
				<a href="<?=base_url('page/'.$data_widget_2->LINK); ?>"><?php echo $data_widget_2->NAMA_MENU; ?></a>
			<?php endforeach; ?>
			</ul>
			<?php else: ?>
			Tidak ada data
			<?php endif; ?>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->

<div class="link-widget">
    <div class="widget">
        <h3>Tentang Indobaba</h3>
       <?php if($widget_1): ?>
			<ul>
			<?php foreach($widget_1 as $data_widget_1): ?>
				<li><a href="<?=base_url('page/'.$data_widget_1->LINK); ?>"><?php echo $data_widget_1->NAMA_MENU; ?></a></li>
			<?php endforeach; ?>
			</ul>
			<?php else: ?>
			Tidak ada data
			<?php endif; ?>
    </div><!-- /.widget -->
</div><!-- /.link-widget -->
<!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    © <a href="<?php echo base_url() ?>">Indobaba Group</a> - all rights reserved
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
	<script src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/css_browser_selector.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/echo.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.easing-1.3.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap-slider.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.raty.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.prettyPhoto.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.customSelect.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/wow.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
    <script type="text/javascript">

$(window).scroll(function(event) {

    var y = $(this).scrollTop();

    if (y >= 500) {
        $('.inherit').addClass('fixed');
    };

    if (y >= 900) {
        $('.inherit').removeClass('fixed');
    };

    if (y <= 500) {
        $('.inherit').removeClass('fixed');
    };
});
  $(function() {
    $( "#datepicker" ).datepicker();
  });

</script>
</body>

                

</html>