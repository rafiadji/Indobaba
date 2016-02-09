<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-xs-12 col-md-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<div class="form-group">
				<a href="<?php echo site_url('admin_halaman/tambah'); ?>" class="btn btn-primary btn-block btn-lg">Tambah</a>
			</div>
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
				<th>No</th>
				<th>Nama Menu</th>
				<th>Judul</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
        </thead>
       <tbody>
       	<?php 
	$no = 1;
	foreach($tampil as $row):?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo $row->NAMA_MENU ?></td>
		<td><?php echo $row->JUDUL ?></td>
		<td>
		<?php if($row->STATUS==1){ ?>
		Publikasi
		<?php }
		else{ ?>
		Draft
		<?php } ?>
		</td>
		<td>
		<div class="btn-group">
			<a href="<?php echo site_url('admin_halaman/halaman/'.$row->LINK); ?>" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Preview</a>
			<a href="<?php echo site_url('admin_halaman/editHalaman/'.base64_encode_fix($row->ID)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
			<a onclick="return confirm('Yakin Menghapus Data ini?')" href="<?php echo site_url('admin_halaman/hapusHalaman/'.base64_encode_fix($row->ID)); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
        $("#example1").dataTable();
    });
</script>