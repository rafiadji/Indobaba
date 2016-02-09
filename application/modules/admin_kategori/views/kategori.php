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
		<?php echo anchor('admin_kategori/tambahkategori', "Tambah",array('class' => 'btn btn-primary btn-block btn-lg'));?>
	</div>
	<div class="list-group">
		<?php echo anchor('admin_kategori/lihatsubkategori', "Sub Kategori",array('class' => 'list-group-item'));?>
	</div>
</div>
<div class="col-md-9 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
		        <th>Nama Kategori</th>
		        <th>Aksi</th>
		    </tr>
        </thead>
       <tbody>
       	<?php if($tampil): ?>
    <?php foreach($tampil as $row): ?>
        <tr>
            <td><?php echo $row->KATEGORI;?></td>
            <td><?php echo anchor("admin_kategori/editkategori/".$row->ID_KATEGORI,"Edit",array('class' => 'btn btn-info btn-xs'))?> 
                <?php echo anchor("admin_kategori/hapuskategori/".$row->ID_KATEGORI,"Hapus",array('class' => 'btn btn-danger btn-xs','onClick' => "return confirm('Hapus Kategori $row->KATEGORI ?')"))?></td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
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

