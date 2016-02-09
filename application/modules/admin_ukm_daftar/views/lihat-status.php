<h4>
	<?php
	if($id_status == 1){
		echo "Sudah Dihubungi";	
	}
	elseif($id_status == 0){
		echo "Belum Dihubungi";
	}
	?>
</h4>
<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
		        <th>Nama Produsen</th>
		        <th>No Telp</th>
		        <th>Jenis Usaha</th>
		        <th>Aksi</th>
		    </tr>
        </thead>
       <tbody>
       	<?php if($tampil): ?>
    <?php foreach($tampil as $row): ?>
        <tr>
            <td><?php echo $row->NAMA_UKM;?></td>
            <td><?php echo $row->NO_TELP;?></td>
            <td><?php echo $row->NM_USAHA;?></td>
             <td>
            	<?php if($row->STS == 1): ?>
            	-
            	<?php else: ?>
            	<a href="<?php echo base_url('admin_ukm_daftar/ubahStatus/'.$row->ID_DAFTAR_UKM); ?>" class="btn btn-info">Follow Up</a>
            	<?php endif; ?>
            </td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
       </tbody>
</table>
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
    });
    </script>