<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<?php echo anchor("user_alamat/tambahAlamat","Tambah Alamat",array("class" => "btn btn-info"));?>
<table>
    <tr>
        <th>Alamat</th>
        <th>Status</th>
        <th></th>
        <th></th>
    </tr>
    <?php if($tampil):?>
    <?php foreach($tampil as $row):?>
    <tr>
        <td><?php echo $row->ALAMAT;?></td>
        <td><?php if($row->STS == 1): echo "Default"; else: echo "Undefault"; endif;?></td>
        <td><?php $id = base64_encode_fix($row->ID_ALAMAT);echo anchor("user_alamat/editAlamat/$id","Edit",array("class" => "btn btn-success"))?></td>
        <td><?php base64_encode_fix($row->ID_ALAMAT);echo anchor("user_alamat/hapusAlamat/$id","Hapus",array("class" => "btn btn-danger",'onClick' => "return confirm('Hapus $row->ALAMAT ?')"))?></td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    
</table>
    