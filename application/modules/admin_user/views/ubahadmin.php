<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="<?=base_url()?>admin_user/ubahAdminsubmit">
<input type="hidden" name="ID_ADMIN" value="<?=$edit->ID_ADMIN?>"/>
<table>
	<tr>
		<td>Nama</td>
		<td><input type="text" name="NAMA" value="<?=$edit->NAMA?>" /></td>
	</tr>
	<tr>
		<td>No Telepon</td>
		<td><input type="text" name="NO_TELP" value="<?=$edit->NO_TELP?>" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Ubah Admin" /></td>
	</tr>
</table>
</form>