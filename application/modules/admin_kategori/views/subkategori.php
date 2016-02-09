<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="btn btn-group">
    <?php echo anchor('admin_kategori/tambahsubkategori', "Tambah SubKategori",array('class' => 'btn btn-success btn-sm'));?>
    <?php echo anchor('admin_kategori', "Kategori",array('class' => 'btn btn-info btn-sm'));?>
</div>
<div class="col-md-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
		         <td>Sub Kategori</td>
        		<td>Kategori Utama</td>
        		<td>Aksi</td>
		    </tr>
        </thead>
       <tbody>
       	 <?php if($tampil): ?>
    <?php foreach($tampil as $row): ?>
        <tr>
            <td><?php echo $row->SUB_KATEGORI;?></td>
            <td><?php echo $row->KATEGORI;?></td>
            <td><?php echo anchor("admin_kategori/editsubkategori/".$row->ID_SUB_KATEGORI,"Edit",array('class' => 'btn btn-info btn-xs'))?>
                <?php echo anchor("admin_kategori/hapussubkategori/".$row->ID_SUB_KATEGORI,"Hapus",array('class' => 'btn btn-danger btn-xs','onClick' => "return confirm('Hapus Sub Kategori $row->SUB_KATEGORI ?')"))?></td>
        </tr>
        <?php endforeach;?>
    <?php else: ?>
    	tidak ada data
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