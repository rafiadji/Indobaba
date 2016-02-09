<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Toko <?php echo $this->infomodel->templateE_toko();?></title>
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
            <a href="<?php echo base_url() ?>ukm_info/" class="logo" style="background-color: #E87F4C;">
               Halaman Toko
            </a>
            <nav class="navbar navbar-static-top" style="background-color: #E87F4C;">
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
                                <span><?php echo $this->infomodel->templateE_toko();?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue" style="    background-color: #E87F4C">
                                    <img src="<?php echo base_url(); ?>assets-admin/img/admin-icon.png" class="img-circle" alt="User Image" />
                                    <p>
                                       Toko <?php echo $this->infomodel->templateE_toko();?> 
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url() ?>ukm_info/gantipassword/" class="btn btn-default btn-flat">Ganti Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url("login/logout_ukm") ?>" class="btn btn-default btn-flat">Sign out</a>
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
                            <p><?php echo $this->infomodel->templateE_toko();?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                       
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-cubes"></i>
                                <span>Transaksi</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="<?php echo base_url();?>ukm_info/orderan/2"><i class="fa fa-list"></i>&nbsp;Orderan Masuk<span class="label label-danger pull-right" id="orderanbaru"></span></a></li>
								<li><a href="<?php echo base_url();?>ukm_info/orderan/4"><i class="fa fa-list"></i>&nbsp;Orderan Berhasil</a></li>
								<li><a href="<?php echo base_url();?>ukm_info/orderan/5"><i class="fa fa-list"></i>&nbsp;Orderan Batal</a></li>
							</ul>
                        </li>
                         <li>
                            <a href="<?php echo base_url() ?>ukm_info/"><i class="fa fa-home"></i> <span>Profile Toko</span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url() ?>ukm_info/rekening/"><i class="fa fa-credit-card"></i> <span>Rekening</span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url() ?>ukm_info/gantikurir/"><i class="fa fa-truck"></i> <span>Kurir</span>
                            </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url() ?>ukm_info/gantipassword/"><i class="fa fa-unlock"></i> <span>Ganti Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() ?>ukm_info/pesan/"><i class="fa fa-envelope"></i> <span>Tanya Admin</span><span class="label label-danger pull-right" style="display:none" id="bintang" ><i class="fa fa-star"></i></span>
                            </a>
                        </li>
                      
                        <li>
                            <a href="<?php echo base_url("login/logout_ukm") ?>"><i class="fa fa-lock"></i> <span>Logout</span>
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
        hitungtransaksibaru();
        hitungtransaksiresi();
		bintang();
		setInterval(function(){ bintang(); }, 30000);
        //setInterval(function(){ autoupdatevoicemessage(); }, 5000);
        setInterval(function(){ hitungtransaksibaru(); }, 30000);
	});
    function autoupdatevoicemessage(){
         $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/autoupdatevoicemessage/',
            success: function(data){
                    if(data == 1){
                         var audio = new Audio("<?php echo base_url();?>assets-admin/mtt.mp3");
                         audio.play();
                        updatevoice();
                    }
             }
         });
    }
    function updatevoice(){
        $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/updatevoice/',
            success: function(data){
                  
             }
         });
    }
	function bintang(){
		  $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/notif_bintang/',
            success: function(data){
					if (data == 0) {
						$("#bintang").hide();
					}
					else{

						$("#bintang").show();
                        //var audio = new Audio("<?php echo base_url();?>assets-admin/mtt.mp3");
                        //audio.play();
					}
             }
         });

	}
    function hitungtransaksibaru(){
          $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/hitung_transaksi_baru/',
            success: function(data){
                   $("#orderanbaru").text(data);
             }
         });
    }
    function hitungtransaksiresi(){
          $.ajax({
            type: "POST",
            dataType: "html",
            url: '<?php echo base_url()?>ukm_info/hitung_transaksi_resi/',
            success: function(data){
                   $("#orderanresi").text(data);
             }
         });
    }
</script>
</html>