<form method="POST" action="<?=base_url();?>admin_produk/ubahfotoProduksubmit" enctype="multipart/form-data">
<table>
	<tr>
		<td>silahkan masukkan foto</td>
		<td>&nbsp;</td>
	</tr>
	<input type="hidden" name="ID_PRODUK" value="<?=$edit->ID_PRODUK?>" />
	<input type="hidden" name="ID_GALERI_PRO" value="<?=$edit->ID_GALERI_PRO?>" />
		<tr>
			<td><input type="file" name="userfile[]"/></td>
		</tr>
		<tr>
			<td><input type="submit" value="Upload" /></td>
		</tr>
	
</table>
</form>
<script type="text/javascript">
	// var maxAppend = 0;
	// $(document).ready(function() {
	// 	$('#tambahfoto').click(function() {
	// 		if (maxAppend >= 5) return;
	// 		var element = $('<td id="foto-hapus'+maxAppend+'"><input type="file" name="userfile[]"/><span onclick="hapusfoto(\''+maxAppend+'\')">hapus foto</span></td>');
	// 		maxAppend++;
	// 		$('#uploadan').append(element);
	// 	})		
	// })
	// function hapusfoto(id) {
	// 	$('#foto-hapus'+id).remove();
	// 	maxAppend--;
	// }
</script>