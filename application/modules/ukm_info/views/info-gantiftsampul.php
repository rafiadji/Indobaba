<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
    <form method="POST" enctype="multipart/form-data" >
         <table>
            <tr>
                <td><img src="<?php echo base_url();?>upload/sampul/<?php echo $tampil->FT_SAMPUL;?>" style="width:150px;"></td>
                <td><input type="file" name="userfile"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="simpan" value="Simpan" class="btn btn-success"></td>
            </tr>
         </table>
    </form>