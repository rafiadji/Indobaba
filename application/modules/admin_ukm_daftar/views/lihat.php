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
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
				<label>Status</label>
				<select class="form-control col-md-4" name="status" id="status">
					<option value="0">Belum Dihubungi</option>
					<option value="1">Sudah Dihubungi</option>
				</select>
				</div>
			</div>
		</div>
		<hr />
			<div id="statusnya">
					<h4>Belum Dihubungi</h4>
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
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
		$("#status").change(function(){
			var status = $("#status").val();
			$("#statusnya").html('<p>Tunggu sebentar...</p>');
			$.ajax({
				type:"POST",
				url:"<?=site_url('admin_ukm_daftar/statusDaftar')?>",
				data:'status='+status,
				success:function(data) {
					$("#statusnya").html(data);
				}
			})
		});
		 
	})
   $(function() {
        $("#example1").dataTable();
    });
</script>

