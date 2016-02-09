<?php foreach($kecamatan as $data_kecamatan):?>
	<option value="<?php echo $data_kecamatan->ID_KECAMATAN; ?>">
		<?php echo $data_kecamatan->KECAMATAN?>
	</option>
<?php endforeach; ?>