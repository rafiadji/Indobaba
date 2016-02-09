<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-md-3 col-xs-12">
	<div class="form-group">
			<?=anchor("admin_user/tambahAdmin/","Tambah",array('class' => 'btn btn-primary btn-block btn-lg'))?>
	</div>
</div>
<div class="col-md-9 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
				<th>Nama Admin</th>
				<th>No Telp.</th>
				<th>Aksi</th>
			</tr>
        </thead>
       <tbody>
       	<?php if($tampil): ?>
		<?php foreach($tampil as $row): ?>
		<tr>
			<td><?= $row->NAMA;?></td>
			<td><?= $row->NO_TELP;?></td>
			<td>
				<div class="btn-group">
					<?= anchor("admin_user/ubahAdmin/".$row->ID_ADMIN,"<i class='fa fa-pencil'></i> Edit",array('class' => 'btn btn-info'))?>
					<?= anchor("admin_user/hapusAdmin/".$row->ID_ADMIN,"<i class='fa fa-trash'></i> Hapus",array('class' => 'btn btn-danger','onClick' => "return confirm('Hapus Admin $row->NAMA ?')"))?>
				</div>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php endif;?>
       </tbody>
        </table>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable( {
	         "bLengthChange": false,
	      } );
    });
</script>