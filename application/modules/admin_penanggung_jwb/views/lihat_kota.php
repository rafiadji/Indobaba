<?php foreach($kota as $data_kota):?>
	<option value="<?php echo $data_kota->ID_KOTA; ?>">
		<?php echo $data_kota->KOKAB?>
	</option>
<?php endforeach; ?>