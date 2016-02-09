<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="<?=base_url();?>/admin_rekening/tambahRekeningsubmit">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Tambah Rekening" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_rekening') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label>No Rekening</label>
				<input type="text" class="form-control" name="NO_REKENING"/>
			</div>
			<div class="form-group">
				<label>Rekening untuk :</label>
				<select name="LEVEL" class="form-control" id="level">
					<option value="">Pilih Peruntukan Rekening</option>
					<option value="1">Admin</option>
					<option value="2">UKM</option>
					<option value="3">Penanggung Jawab</option>
				</select>
			</div>
			<div class="tam_milik">
				<div class="form-group tampil_pemilik" style="display: none">
					
				</div>
			</div>
			<div class="form-group">
				<label>Bank</label>
				<select name="ID_BANK" class="form-control">
					<option value="">Pilih Bank</option>
					<?php foreach ($bank as $row):?>
					<option value="<?=$row->ID_BANK?>"><?=$row->BANK?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#level").change(function(){
			var level = $("#level").val();
			var milik = "";
			var tampemilik = $();
			if (level == 1) {
				milik = 'Pilih Pemilik Admin';
				tampemilik = $(
					'<label>'+milik+'</label>'+
					'<select name="ID_PEMILIK" class="form-control pemilik">'+
						'<option value="">'+milik+' Terlebih Dahulu</option>'+
					'</select>'
				);
			}
			else if (level == 2) {
				milik = 'Pilih Pemilik UKM';
				tampemilik = $(
					'<label>'+milik+'</label>'+
					'<select name="ID_PEMILIK" class="form-control pemilik">'+
						'<option value="">'+milik+' Terlebih Dahulu</option>'+
					'</select>'
				);
			}
			else if (level == 3) {
				milik = 'Pilih Pemilik Penanggung Jawab';
				tampemilik = $(
					'<label>'+milik+'</label>'+
					'<select name="ID_PEMILIK" class="form-control pemilik">'+
						'<option value="">'+milik+' Terlebih Dahulu</option>'+
					'</select>'
				);
			}
			else{
				tampemilik = $();
			};
			$(".tam_milik").html(
				'<div class="form-group tampil_pemilik" style="display: none">'+
				'</div>'
			);
			$(".tampil_pemilik").show();
			$(".tampil_pemilik").append(tampemilik);
			$.ajax({
				type:"POST",
				url:"<?=site_url('admin_rekening/dapatLevel')?>",
				data:'level='+level,
				success:function(data) {
					$(".pemilik").html(data);
				}
			})
		});
		
	})
</script>