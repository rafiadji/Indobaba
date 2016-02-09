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
	<div class="panel panel-default">
		<div class="panel-body">
			<?php echo anchor("admin_slider/tambahSlider/","Tambah Slider",array('class' => 'btn btn-primary btn-lg'))?>
		</div>
	</div>
</div>
  
	<?php if($tampil):?>
    <?php foreach($tampil as $row):?>
    <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo base_url();?>assets/images/slider/<?php echo $row->FT_SLIDER;?>" style="width: 100%">
      <div class="caption">
      	<div class="btn-group">
      		<?php echo anchor("admin_slider/editSlider/$row->ID_SLIDER","<i class='fa fa-pencil'></i> Edit",array('class' => 'btn btn-info'));?>
        	<?php echo anchor("admin_slider/hapusSlider/$row->ID_SLIDER","<i class='fa fa-trash'></i> Hapus",array('class' => 'btn btn-danger','onClick' => "return confirm('Hapus gambar $row->NAMA_SLIDER ?')"));?>
      	</div>  
      </div>
    </div>
  </div>
    <?php endforeach;?>
	<?php endif;?>