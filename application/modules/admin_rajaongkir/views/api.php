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
		<a href="<?php echo site_url('admin_rajaongkir/tambah'); ?>" class="btn btn-primary btn-block btn-lg">Tambah</a>
	</div>
</div>
<div class="col-md-9 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">

        <thead>
        	<tr>
				<th>No</th>
				<th>Nama Akun</th>
				<th>Tipe Akun</th>
				<th>Aksi</th>
			</tr>
        </thead>
<tbody>
	<?php 
	$no = 1;
	foreach($tampil as $row):?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo $row->NAMA;?></td>
		<td><?php echo $row->TIPE_AKUN;?></td>
		<td>
		<div class="btn-group">
		<a href="<?php echo site_url('admin_rajaongkir/editRajaongkir/'.base64_encode_fix($row->ID)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
		<a onclick="return confirm('Yakin Menghapus Data ini?')" href="<?php echo site_url('admin_rajaongkir/hapusrRajaongkir/'.base64_encode_fix($row->ID)); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>		
		</div>
		</td>
	</tr>
	<?php endforeach;?>
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