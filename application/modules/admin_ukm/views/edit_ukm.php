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
	            <li <?php if($page_ukm == 'informasi-umum') echo 'class="active"'?>><a href="<?php echo base_url('admin_ukm/editUkm/'.base64_encode_fix($id)) ?>"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Informasi Umum</a></li>
	            <li <?php if($page_ukm == 'rekening-ukm') echo 'class="active"'?>><a href="<?php echo base_url('admin_ukm/rekeningUkm/'.base64_encode_fix($id)) ?>"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Rekening</a></li>
	            <li <?php if($page_ukm == 'lihat-produk') echo 'class="active"'?>><a href="<?php echo base_url('admin_ukm/lihatProduk/'.$id) ?>"><i class="fa fa-archive"></i>&nbsp;&nbsp;Produk Ukm</a></li>
	        <!--    <li <?php if($page_ukm == 'ekspedisi-ukm') echo 'class="active"'?>><a href="<?php echo base_url('admin_ukm/ekspedisiUkm/'.base64_encode_fix($id)) ?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;Ekspedisi</a></li>
	        --></ul>
	        <div class="tab-content">
	            <div class="tab-panes">
	                <?php $this->load->view($page_ukm);?>
				</div>
		</div>
	</div>
</div>
	