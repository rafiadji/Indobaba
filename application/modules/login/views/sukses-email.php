<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if($this->session->flashdata('notif')): ?>
<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
<?php endif; ?>
		</div>
	</div>
</div>