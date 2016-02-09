<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrator Page</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url(); ?>assets-admin/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets-admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets-admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets-admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets-admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets-admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url(); ?>assets-admin/js/jquery.min.js"></script>
        </head>
    <body class="skin-blue">
        <header class="header">
            <a href="<?php echo base_url("admin") ?>" class="logo">
               ADMIN PAGE
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>ADMIN <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url(); ?>assets-admin/img/admin-icon.png" class="img-circle" alt="User Image" />
                                    <p>
                                       ADMIN - 
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url("admin/gantiPassword")?>" class="btn btn-default btn-flat">Ganti Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url("login/logout_admin")?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">              
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url(); ?>assets-admin/img/admin-icon.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>ADMIN</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo base_url("admin_controller") ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                       <li class="treeview <?php if($this->session->userdata('menu_admin') == "master_data") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-cubes"></i>
                                <span>Master Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("admin_rekening") ?>"><i class="fa fa-credit-card"></i>&nbsp;Master Rekening</a></li>
                            <!-- <li><a href="<?php echo base_url("admin_ekspedisi") ?>"><i class="fa fa-truck"></i>&nbsp;Master Ekspedisi</a></li>
                            --></ul>
                        </li>
                        <li class="treeview <?php if($this->session->userdata('menu_admin') == "orderan") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-cubes"></i>
                                <span>Orderan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <?php
                            $baru = $this->db->query("SELECT * FROM view_transaksi WHERE ID_STATUS='1'")->result();
                            $tanggap = $this->db->query("SELECT * FROM mp_transaksi WHERE ID_STATUS='2'")->result();
                            $ber = $this->db->query("SELECT * FROM mp_transaksi WHERE ID_STATUS='4'")->result();
                            $gg = $this->db->query("SELECT * FROM mp_transaksi WHERE ID_STATUS='5'")->result();
                            ?>
                            <ul class="treeview-menu">
                                <li <?php if($this->session->userdata('submenu')==1) echo "class='active'"; ?> ><a href="<?php echo base_url("admin_transaksi/tabel/1") ?>"><i class="fa fa-list"></i>&nbsp;Orderan Masuk <span style='color:red'><?php  //echo count($baru); ?></span></a></li>
                                <li <?php if($this->session->userdata('submenu')==2) echo "class='active'"; ?> ><a href="<?php echo base_url("admin_transaksi/tabel/2") ?>"><i class="fa fa-list"></i>&nbsp;Orderan Ditanggapi <span style='color:red'><?php  //echo count($tanggap); ?></span></a></li>
                                <li <?php if($this->session->userdata('submenu')==4) echo "class='active'"; ?> ><a href="<?php echo base_url("admin_transaksi/tabel/4") ?>"><i class="fa fa-list"></i>&nbsp;Orderan Berhasil <span style='color:red'><?php  //echo count($ber); ?></span></a></li>
								<li <?php if($this->session->userdata('submenu')==5) echo "class='active'"; ?> ><a href="<?php echo base_url("admin_transaksi/tabel/5") ?>"><i class="fa fa-list"></i>&nbsp;Orderan Gagal <span style='color:red'><?php // echo count($gg); ?></span></a></li>
                            </ul>
                        </li>
                       <li class="treeview <?php if($this->session->userdata('menu_admin') == "master_ukm") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-briefcase"></i>
                                <span>Master UKM</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="<?php echo base_url("admin_kategori") ?>"><i class="fa fa-tags"></i>&nbsp;Kategori Produk UKM</a></li>
								<li><a href="<?php echo base_url("admin_penanggung_jwb") ?>"><i class="fa fa-user"></i>&nbsp;Penanggung Jawab UKM</a></li>
                                <li><a href="<?php echo base_url("admin_ukm") ?>"><i class="fa fa-home"></i>&nbsp;UKM</a></li>
                                <li><a href="<?php echo base_url("admin_produk") ?>"><i class="fa fa-archive"></i>&nbsp;Produk UKM</a></li>
                                <li><a href="<?php echo base_url("admin_ukm_daftar") ?>"><i class="fa fa-user"></i>&nbsp;Permintaan Bergabung</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php if($this->session->userdata('menu_admin') == "master_user") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Master User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("admin_user/") ?>"><i class="fa fa-user"></i>&nbsp;Administrator Web</a></li>
								<li><a href="<?php echo base_url("admin_customers/") ?>"><i class="fa fa-user"></i>&nbsp;Customers Web</a></li>
                            
							</ul>
                        </li>
                        <li class="treeview <?php if($this->session->userdata('menu_admin') == "master_tampilan") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-th-large"></i>
                                <span>Tampilan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                               <li><a href="<?php echo base_url('admin_slider')?>"><i class="fa fa-image"></i> Slider</a></li>
                               <li><a href="<?php echo base_url('admin_halaman')?>"><i class="fa fa-list"></i> Halaman</a></li>
                               <li><a href="<?php echo base_url('admin_widget')?>"><i class="fa fa-list"></i> Widget</a></li>
							</ul>
                        </li>
                         <li class="treeview <?php if($this->session->userdata('menu_admin') == "master_diskusi") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                <span>Diskusi</span>
                                <i class="fa fa-angle-left pull-right"></i><span class="label label-danger pull-right" style="display:none" id=bintang ><i class="fa fa-star"></i></span>
                            </a>
                            <ul class="treeview-menu">
                            	<li><a href="<?php echo base_url('admin_diskusi')?>"><i class="fa fa-envelope"></i> Pesan UKM</a></li>
							</ul>
                        </li>
                        <li class="treeview <?php if($this->session->userdata('menu_admin') == "master_api") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-code-fork"></i>
                                <span>API</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	<li><a href="<?php echo base_url('admin_api')?>"><i class="fa fa-code-fork"></i> Zenziva ( SMS )</a></li>
								<li><a href="<?php echo base_url('admin_rajaongkir')?>"><i class="fa fa-code-fork"></i> RajaOngkir</a></li>
							</ul>
                        </li>
						<li class="treeview <?php if($this->session->userdata('menu_admin') == "master_pengaturan") echo "active" ?>">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span>Pengaturan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url("admin_keuntungan/") ?>"><i class="fa fa-money"></i>&nbsp;Keuntungan</a></li>
                                <li><a href="<?php echo base_url("admin_info_web/") ?>"><i class="fa fa-info-circle"></i>&nbsp;Informasi Web</a></li>
                                <li><a href="<?php echo base_url("admin_user/ubahpasswordAdmin") ?>"><i class="fa fa-unlock-alt"></i>&nbsp;Ganti Password</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url("login/logout_admin") ?>"><i class="fa fa-lock"></i> <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>

            <aside class="right-side">                
                <section class="content-header">
                    <h1>
                        <?php echo $judul_page; ?>
                        <small><?php echo $des_page; ?></small>
                    </h1>
                    
                </section>
                <section class="content">
					<div class="row">
						<?php $this->load->view($page); ?>
					</div>
                </section>
            </aside>
        </div>
        <script src="<?php echo base_url(); ?>assets-admin/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets-admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets-admin/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets-admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets-admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    </body>
	<script>
	$( document ).ready(function() {
		bintang();
		setInterval(function(){ bintang(); }, 5000);
	});
	function bintang(){
		  $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>admin_diskusi/notif_bintang/',
            success: function(data){
					if (data == 0) {
						$("#bintang").hide();
					}
					else{
						$("#bintang").show();
					}
                    //alert(data);
             }
         });
	}
</script>
</html>