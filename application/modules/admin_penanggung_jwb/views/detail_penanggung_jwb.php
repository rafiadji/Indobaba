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

                                    <li <?php if($page_penanggung_jwb == 'informasi-umum') echo 'class="active"'?>><a href="<?php echo base_url('admin_penanggung_jwb/editPenanggungJwb/'.$id_penanggung_jwb) ?>"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;Informasi Umum</a></li>

                                    <li <?php if($page_penanggung_jwb == 'rekening-penanggung-jwb') echo 'class="active"'?>><a href="<?php echo base_url('admin_penanggung_jwb/tambahRekening/'.$id_penanggung_jwb) ?>"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Data Rekening</a></li>

                                    <li <?php if($page_penanggung_jwb == 'lihat-ukm') echo 'class="active"'?>><a href="<?php echo base_url('admin_penanggung_jwb/lihatUkm/'.$id_penanggung_jwb) ?>"><i class="fa fa-users"></i>&nbsp;&nbsp;Anggota UKM</a></li>

                                </ul>

                                <div class="tab-content">

                                    <div class="tab-panes">

                                        <?php $this->load->view($page_penanggung_jwb);?>

            						</div>

        						</div>

    </div>

	

</div>

