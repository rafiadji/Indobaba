<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<div class="col-md-12 col-xs-12">
	<div class="panel panel-default">
		<div class="panel-body table-responsive">
			<table id="example1" class="table table-bordered table-striped">
        <thead>
        	<tr>
				<th>Nama</th>
				<th>Email</th>
				<th>Tanggal Terdaftar</th>
				<th>Jumlah Transaksi</th>
			</tr>
        </thead>
       <tbody>
       	<?php if($penanggung_jwb_ukm): ?>
	<?php foreach($penanggung_jwb_ukm as $data): ?>
	<tr>
		<td><?php echo $data->NAMA ?></td>
		<td><?php echo $data->EMAIL ?></td>
		<td><?php echo $data->TGL_TERDAFTAR ?></td>
		<td><?php 
			$q = $this->db->query("SELECT * FROM view_detail_transaksi WHERE ID_PENANGGUNG_JWB='$data->ID_PENANGGUNG_JWB' GROUP BY NO_TRANS")->result();
		 	echo count($q); 
		?></td>
	</tr>
	<?php endforeach; ?>
	<?php endif; ?>
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