<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<table>
    <tr>
        <th>Ekspedisi</th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        
    </tr>
</table>
<?php echo "dw"?>