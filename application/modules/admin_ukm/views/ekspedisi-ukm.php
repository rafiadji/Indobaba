<div class="row">
	<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<?php echo anchor("admin_ukm/ekspedisiUkmtambah/$id_encode","Tambah Ekspedisi",array("class"=>"btn btn-default btn-lg"));?>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
				<th>Nama</th>
		       <th></th>
			</tr>
        </thead>
       <tbody>
       	<?php if($tampil): ?>
    <?php foreach($tampil as $roww):?>
    <?php $tm = $this->adminukm->tampilData("mp_ekspedisi","*",array("ID_EKSPEDISI" => $roww->ID_EKSPEDISI),TRUE); ?>
    <tr>
        <td><?php echo $tm->NAMA_EKSPEDISI;?></td>
		<td><?php echo anchor("admin_ukm/hapusekspedisi/$id_encode/$roww->ID_EKS_UKM","Hapus",array("class" => "btn btn-danger",'onClick' => "return confirm('Hapus $tm->NAMA_EKSPEDISI ?')"));?></td>
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
        $("#example1").dataTable( {
	         "bLengthChange": false,
	      } );
    });
</script>
</div>