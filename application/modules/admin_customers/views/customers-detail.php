<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-md-12">
	<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs">
	            <li <?php if($page_costumer == 'informasi-umum') echo 'class="active"' ?>><a href="<?php echo base_url('admin_ukm/editUkm/') ?>"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Informasi Umum</a></li>
	            <li><a href="<?php echo base_url('admin_ukm/rekeningUkm/') ?>"><i class="fa fa-money"></i>&nbsp;&nbsp;Tagihan</a></li>
	            <li><a href="<?php echo base_url('admin_ukm/ekspedisiUkm/') ?>"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Rekening</a></li>
	        </ul>
	        <div class="tab-content">
	            <div class="tab-panes">
	                <?php $this->load->view($page_costumer);?>
				</div>
			</div>
	</div>
</div>
