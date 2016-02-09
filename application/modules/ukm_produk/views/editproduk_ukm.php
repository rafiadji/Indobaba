<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="<?=base_url();?>ukm_produk/ubahProduksubmit">
<input type="hidden" name="ID_PRODUK" value="<?=$edit->ID_PRODUK?>" />
<table>
	<tr>
		<td>Nama Produk</td>
		<td><input type="text" name="NM_PRODUK" value="<?=$edit->NM_PRODUK?>" /></td>
	</tr>
	<tr>
		<td>Kategori Produk</td>
		<td>
			<select name="ID_KATEGORI" id="kategori">
				<option value="0">Pilih Kategori Produk</option>
				<?php foreach ($kategori as $row) { ?>
				<option value="<?=$row->ID_KATEGORI?>" <?php if($row->ID_KATEGORI == $edit->ID_KATEGORI){ echo 'selected';}?>><?=$row->KATEGORI?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Sub Kategori Produk</td>
		<td>
			<select name="ID_SUB_KATEGORI" id="subkategori">
				<option value="0">Pilih Sub Kategori Produk</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Berat Produk</td>
		<td><input type="text" name="BERAT_PRODUK" value="<?=$edit->BERAT_PRODUK?>" /></td>
	</tr>
	<tr class="minpesan">
		<td>Minimal Pesan</td>
		<td><input type="text" name="MIN_PESAN" value="<?=$edit->MIN_PESAN?>" class="min_pesan" onkeyup="minpesan(0)" /></td>
	</tr>
	<tr>
		<td><input type="checkbox" onclick="toggle('.grosir', this)" <?php if($edit->STS_GROSIR == 1){ echo 'checked';}?>> Gunakan Harga Grosir</td>
		<td>
		<div class="grosir" <?php if($edit->STS_GROSIR == 0){ echo 'style="display: none"';}?>>
			<span onclick="fGrosir()" class="tomgros">Tambah</span>
			<div class="field_grosir">
			<?php 
			$jumlah = 0; 
			$hgrosir1 = explode('|', $edit->HARGA);
			array_pop($hgrosir1);
			foreach ($hgrosir1 as $rowi) {
				$hgrosir2 = explode('-', $rowi);?>
				<br/>
				<input type="text" name="tgrosir<?=$jumlah?>" value="<?=$hgrosir2[0]?>" disabled> 
				<input type="hidden" name="grosir[]" value="<?=$hgrosir2[0]?>" class="hgrosir<?=$jumlah?>"> - 
				<input type="text" name="grosir[]" class="aGrosir<?=$jumlah?>" value="<?=$hgrosir2[1]?>" onkeyup="ugrosir(<?=$jumlah?>,<?=($jumlah+1)?>)"/>
				Rp <input type="text" name="grosir[]" value="<?=$hgrosir2[2]?>"/>
			<?php $jumlah++; }	?>
			</div>
		</div>
		</td>
	</tr>
	<tr class="harga_pro" <?php if($edit->STS_GROSIR == 1){ echo 'style="display: none"';}?>>
		<td>Harga Produk</td>
		<td><input type="text" name="HARGA" value="<?php if($edit->STS_GROSIR == 1){ echo '0';}else{echo $edit->HARGA;}?>" class="hpro" /></td>
	</tr>
	<tr>
		<td>Deskripsi Produk</td>
		<td><textarea name="DES_PRODUK"><?=$edit->DES_PRODUK?></textarea></td>
	</tr>
	<tr>
		<td>Deskripsi Meta</td>
		<td><textarea name="DES_META"><?=$edit->DES_META?></textarea></td>
	</tr>
	<tr>
		<td>Keyword Meta</td>
		<td><textarea name="KEY_META"><?=$edit->KEY_META?></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Ubah Produk" /></td>
	</tr>
</table>
</form>
<script type="text/javascript">
	var jumlah = <?=$jumlah?>;
	$(document).ready(function(){
		$.ajax({
			type:"POST",
			url:"<?=site_url('ukm_produk/dapatSubkategoriedit');?>",
			data:'idkategori='+<?=$edit->ID_KATEGORI?>+'&idsubkategori='+<?=$edit->ID_SUB_KATEGORI?>,
			success:function(data) {
				$("#subkategori").html(data);
			}
		});
		$("#kategori").change(function(){
			var kategori = $("#kategori").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url('ukm_produk/dapatSubkategori')?>",
				data:'key='+kategori,
				success:function(data) {
					$("#subkategori").html(data);
				}
			})
		});
	})

	function toggle(className, obj) {
		var $input = $(obj);
		var element = $(
			'<input type="text" name="tgrosir'+jumlah+'" value="0" disabled> <input type="hidden" name="grosir[]" value="0"> - '+
			'<input type="text" name="grosir[]" class="aGrosir'+jumlah+'" onkeyup="ugrosir('+jumlah+','+(jumlah+1)+')"/>'+
			' Rp <input type="text" name="grosir[]"/>');
		if ($input.prop('checked')){
			$(className).show();
			$('.field_grosir').append(element);
			$('.harga_pro').hide();
			$('.minpesan').hide();
			$('.hpro').val('0');
			$('.min_pesan').val('0');

		}
		else {$(className).hide();$(className).html(
			'<div class="grosir" style="display: none">'+
			'<span onclick="fGrosir()" class="tomgros">Tambah</span>'+
			'<div class="field_grosir"></div></div>');
			$('.harga_pro').show();
			$('.minpesan').show();
			$('.hpro').val('');
		}
			
	}
	
	function fGrosir(){
		var aGrosir = parseInt($(".aGrosir"+jumlah).val());
		var element = $(
			'<br/><input type="text" name="tgrosir'+(jumlah+1)+'" value="'+(aGrosir+1)+'" disabled> <input type="hidden" name="grosir[]" value="'+(aGrosir+1)+'" class="hgrosir'+(jumlah+1)+'"> - '+
			'<input type="text" name="grosir[]" class="aGrosir'+ (jumlah+1) +'" onkeyup="ugrosir('+(jumlah+1)+','+(jumlah+2)+')" />'+
			' Rp <input type="text" name="grosir[]"/>');
		$('.field_grosir').append(element);
		jumlah++;
	}

	function ugrosir(jum, jumke) {
		var aGrosir = parseInt($(".aGrosir"+jum).val());
		$("input[name=tgrosir"+jumke+"]").val((aGrosir+1));
		$(".hgrosir"+jumke).val((aGrosir+1));
	}

	function minpesan(jum) {
		var min_pesan = $(".min_pesan").val();
		$("input[name=tgrosir"+jum+"]").val(min_pesan);
		$(".hgrosir"+jum).val(min_pesan);
	}
</script>