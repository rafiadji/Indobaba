<?php foreach($kota->rajaongkir->results as $data_kota):
	if($data_kota->type == 'Kota'){
		$type = '( '.$data_kota->type.' )';
	}
	else{
		$type = '';
	}
?>
	<option value="<?php echo $data_kota->city_id; ?>">
		<?php echo $data_kota->city_name.' '.$type; ?>
	</option>
<?php endforeach; ?>