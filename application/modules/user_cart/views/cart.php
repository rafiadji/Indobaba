<table border="">
<?php foreach ($tampil as $all): ?>
	<?php //$alamat = $this->db->query('SELECT * FROM view_temp_cart')->result(); ?>
	<?php //foreach($alamat as $toko): ?>
	<tr>
		<td><?php echo $all->NM_PRODUK; ?></td>
		<td><?php echo $all->NM_TOKO; ?></td>
		<td><?php echo $all->ALAMAT; ?></td>
	</tr>
	<?php //endforeach; ?>
<?php endforeach; ?>
</table>