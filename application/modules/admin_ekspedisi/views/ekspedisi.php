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
                <?php echo anchor("admin_ekspedisi/tambahData","Tambah",array("class"=>"btn btn-primary btn-block btn-lg"));?>
            </div>
			<table id="example1" class="table table-bordered table-striped">
        		<thead>
        			<tr>
        				<th>Nama</th>
        				<th>Pengaturannya</th>
        				<th>Aksi</th>
					</tr>
        </thead>
       <tbody>
       	<?php if($tampil): ?>
    	<?php foreach($tampil as $row):?>
    	<tr>
        	<td><?php echo $row->NAMA_EKSPEDISI;?></td>
        <td>
        	<div class="btn-group">
	        	<?php echo anchor("admin_ekspedisi/edit/$row->ID_EKSPEDISI","<i class='fa fa-pencil'></i> Edit Ekspedisi",array("class"=>"btn btn-info"));?>
	        	<?php echo anchor("admin_ekspedisi/harga/$row->ID_EKSPEDISI","<i class='fa fa-list'></i> List Harga",array("class"=>"btn btn-info"));?>
	        	<?php echo anchor("admin_ekspedisi/tambahHarga/$row->ID_EKSPEDISI","<i class='fa fa-plus'></i> Tambah Harga",array("class"=>"btn btn-info"));?>
	        </div>
        </td>
        <td>
        	<?php echo anchor("admin_ekspedisi/hapus/$row->ID_EKSPEDISI","<i class='fa fa-trash'></i> Hapus",array("class"=>"btn btn-danger",'onClick' => "return confirm('Hapus Ekspedisi $row->NAMA_EKSPEDISI ?')"));?>
        </td>
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