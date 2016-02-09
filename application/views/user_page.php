<div class="container">

<?php if($this->session->flashdata('notif')): ?>
	<div class="row">
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
</div>
<?php endif; ?>

<div class="row">
	<div class="col-md-12">
		
	<div class="panel panel-default">
		<div class="panel-body" style="padding: 15px">
			
	<div class="col-md-3">
		<div class="panel panel-default">
				<div class="panel-heading">
				<h4 align="center">Panel Saya</h4>
				</div>
						
					<div class="list-group">
						<a href="<?php echo base_url('user_profil') ?>" class="list-group-item"><i class="fa fa-user"></i> Akun Profil</a>
						<a href="<?php echo base_url('user_checkout/checkout') ?>" class="list-group-item"><i class="fa fa-list"></i> Transaksi Saya</a>
						<a href="<?php echo base_url('user_profil/gantipassword') ?>" class="list-group-item"><i class="fa fa-unlock"></i> Ganti Password</a>
						<a href="<?php echo base_url('login/logout_user') ?>" class="list-group-item"><i class="fa fa-lock"></i> Keluar</a>
					</div>
				
		</div>
	</div>
	<div class="col-md-9">
		<div class="row">
			<?php $this->load->view($page_user) ?>
		</div>
	</div>
		</div>
	</div>
	</div>
</div>

</div>