<?php if($this->session->flashdata('notif')): ?>
<div class="col-md-12">
	<div class="alert alert-<?php echo $this->session->flashdata('clr');?> alert-dismissable">
		<i class="fa fa-check"></i>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo $this->session->flashdata('notif'); ?>
	</div>
</div>
<?php endif; ?>
<form method="POST" action="<?=base_url();?>/admin_produk/tambahProduksubmit">
<div class="col-md-8">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-info-circle"></i> Rincian Produk</h4>
			<hr />
			<div class="form-group">
				<label>Nama Produk</label>
				<input type="text" class="form-control" name="NM_PRODUK"/>
			</div>
			
			<div class="form-group" class="form-control">
				<label>Berat</label>
				<div class="input-group">
				  <input type="text" name="BERAT_PRODUK" class="form-control"/>
				  <span class="input-group-addon" id="basic-addon1">Gram</span>
				</div>
			</div>
			<div class="form-group">
				<label>Minimal Pesan</label>
				<input type="text" name="MIN_PESAN" value="1" class="form-control min_pesan" onkeyup="minpesan(0)" />
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-12">
						<input type="checkbox" onclick="toggle('.grosir', this)" > Gunakan Harga Grosir
						
						<div class="grosir" style="display: none">
						<div class="form-group">
							<span onclick="fGrosir()" class="tomgros btn btn-primary">Tambah</span>
						</div>
							<div class="field_grosir">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group harga_pro">
				<label>Harga</label>
				<input type="text" name="HARGA" value="" class="form-control hpro" />
			</div>
			<div class="form-group">
				<textarea name="DES_PRODUK" id="editor1"></textarea>
			</div>
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-tags"></i> Kategori</h4>
			<hr />
			<div class="form-group">
				<label>Pilih UKM</label>
				<select name="ID_TOKO" class="form-control">
				<option value="">Pilih Nama UKM/IKM</option>
				<?php foreach ($toko as $rows): ?>
				<option value="<?=$rows->ID_TOKO?>"><?=$rows->NM_TOKO?></option>
				<?php endforeach; ?>
			</select>
			</div>
			<div class="form-group">
				<label>Kategori</label>
				<select name="ID_KATEGORI" class="form-control" id="kategori">
					<option value="">Pilih Kategori Produk</option>
					<?php foreach ($kategori as $row):?>
					<option value="<?=$row->ID_KATEGORI?>"><?=$row->KATEGORI?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Sub Kategori</label>
				<select name="ID_SUB_KATEGORI" class="form-control" id="subkategori">
					<option value="">Pilih Kategori Terlebih Dahulu</option>
				</select>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<h4><i class="fa fa-globe"></i> Seo Optimize</h4>
			<hr />
			<div class="form-group">
				<label>Deskripsi Meta</label>
				<input name="DES_META" class="form-control">
			</div>
			<div class="form-group">
				<label>Keyword Meta</label>
				<input name="KEY_META" class="form-control">
			</div>
		</div>
	</div>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-body">
			<input type="submit" value="Tambah" class="btn btn-default btn-lg"/>
			<a href="<?php echo base_url('admin_produk') ?>" class="btn btn-info btn-lg">Kembali</a>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	var jumlah = 0;
	$(document).ready(function(){
		$("#kategori").change(function(){
			var kategori = $("#kategori").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url('admin_produk/dapatSubkategori')?>",
				data:'key='+kategori,
				success:function(data) {
					$("#subkategori").html(data);
				}
			})
		});
		
	})
	
	function toggle(className, obj) {
		var $input = $(obj);
		var min_pesan = $(".min_pesan").val();
		var element = $(
			'<div class="input-group"><input class="form-control" type="text" name="tgrosir'+jumlah+'" value="'+min_pesan+'" disabled><span class="input-group-addon" id="basic-addon1">-</span><input type="hidden" name="grosir[]" value="0" class="hgrosir'+jumlah+'">'+
			'<input type="text" name="grosir[]" class="form-control aGrosir'+jumlah+'" onkeyup="ugrosir('+jumlah+','+(jumlah+1)+')"/><span class="input-group-addon" id="basic-addon1">Rp</span>'+
			'<input type="text" class="form-control" name="grosir[]"/></div>');
		if ($input.prop('checked')){
			$(className).show();
			$('.field_grosir').append(element);
			$('.harga_pro').hide();
			$('.hpro').val('0');

		}
		else {$(className).hide();$(className).html(
			'<div class="grosir" style="display: none">'+
			'<span onclick="fGrosir()" class="tomgros btn btn-primary">Tambah</span>'+
			'<div class="field_grosir"></div></div>');
			$('.harga_pro').show();
			$('.hpro').val('');
		}
			
	}
	
	function fGrosir(){
		var aGrosir = parseInt($(".aGrosir"+jumlah).val());
		var element = $(
			'<div class="input-group"><input class="form-control" type="text" name="tgrosir'+(jumlah+1)+'" value="'+(aGrosir+1)+'" disabled><span class="input-group-addon" id="basic-addon1">-</span> <input type="hidden" name="grosir[]" value="'+(aGrosir+1)+'" class="hgrosir'+(jumlah+1)+'">'+
			'<input type="text" name="grosir[]" class="form-control aGrosir'+ (jumlah+1) +'" onkeyup="ugrosir('+(jumlah+1)+','+(jumlah+2)+')" /><span class="input-group-addon" id="basic-addon1">Rp</span>'+
			'<input class="form-control" type="text" name="grosir[]"/></div>');
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
	
	$(function(){
    	CKEDITOR.replace('editor1');
	});
</script>