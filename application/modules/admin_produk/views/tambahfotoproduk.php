<form method="POST" action="<?=base_url();?>admin_produk/tambahfotoProduksubmit" enctype="multipart/form-data">
<input type="hidden" name="ID_PRODUK" value="<?=$edit->ID_PRODUK?>" />
<div class="col-md-12">
	<div class="panel panel-default">
	<div class="panel-body">
		<input type="submit" value="Upload" style="display: none" id="tombolnya" class="btn btn-default btn-lg"/>
		<span class="btn btn-primary btn-lg" id="tambahfoto">Tambah Foto</span>
		<a href="<?php echo base_url('admin_produk/fotoProduk/'.$edit->ID_PRODUK) ?>" class="btn btn-info btn-lg">Kembali</a>	
	</div>
</div>
</div>
<div class="col-md-12" style="display: none" id="formnya">
	<div class="panel panel-default">
		<div class="panel-body" id="uploadan">
			
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	var maxAppend = <?=$jumft?>;
	$(document).ready(function() {
		$('#tambahfoto').click(function() {
			$('#tombolnya').show();
			$('#formnya').show();
			if (maxAppend >= 5) return;
			var element = $('<div id="foto-hapus'+maxAppend+'"><div class="form-group"><label>Foto '+maxAppend+'</label><input class="form-control" type="file" name="userfile[]"/></div><span class="btn btn-danger" onclick="hapusfoto(\''+maxAppend+'\')">hapus foto</span></div>');
			maxAppend++;
			$('#uploadan').append(element);
		})		
	})
	function hapusfoto(id) {
		$('#foto-hapus'+id).remove();
		maxAppend--;
	}
</script>