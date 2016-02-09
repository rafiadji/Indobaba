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
		<a class="btn btn-primary btn-block btn-lg" href="<?php echo site_url('admin_api/tambah'); ?>" class="btn btn-success">Tambah</a>
	</div>
</div>
<div class="col-md-9 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
				<th>No</th>
				<th>Deskripsi</th>
				<th>Aksi</th>
			</tr>
        </thead>
       <tbody>
       	<?php 
	$no = 1;
	foreach($tampil as $row):?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><a href="<?php echo site_url('admin_api/cekKredit/'.base64_encode_fix($row->ID_SETTING)); ?>"><?php echo $row->DESKRIPSI;?></a></td>
		<td>
		<a href="<?php echo site_url('admin_api/editApi/'.base64_encode_fix($row->ID_SETTING)); ?>" class="btn btn-success">Edit</a>
		<a  onclick="return confirm('Yakin Menghapus Data ini?')" href="<?php echo site_url('admin_api/hapusApi/'.base64_encode_fix($row->ID_SETTING)); ?>" class="btn btn-danger">Hapus</a>
		<?php if($row->STATUS==1){ ?>
		<a href="<?php echo site_url('admin_api/status/'.base64_encode_fix($row->ID_SETTING)); ?>" class="btn btn-primary">Aktif</a>
		<?php }
		else{ ?>
		<a href="<?php echo site_url('admin_api/status/'.base64_encode_fix($row->ID_SETTING)); ?>" class="btn btn-warning">Non Aktif</a>
		<?php } ?>
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