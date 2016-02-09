<?php if($alamat): ?>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-3" style="text-align: center">
				<h4 style="color: orange"><?= $alamat->NAMA_PENERIMA?></h4>
				<label><?= $alamat->SIMPAN_SEBAGAI ?></label>
			</div>
			<div class="col-md-9">
				<p><b><?= $alamat->ALAMAT; ?><br/><?= getKabupatenRj($alamat->PROVINSI, $alamat->KOTA_KAB); ?>, <?= $alamat->KODE_POS; ?><?= getKabupatenRj($alamat->PROVINSI, $alamat->KOTA_KAB); ?>, <?= $alamat->KODE_POS; ?>, <?= getProvinsiRj($alamat->PROVINSI); ?></b></p>
				<p style="font-weight: bold">No HP : <?= $alamat->NO_HP_PENERIMA ?></p>
				
			</div>
		</div>
	</div>
</div>
<?php endif; ?>