<table border='1'>
	<?php if($tampil): ?>
	<tr>
		<td>Nama Produk</td>
		<td>Berat</td>
		<td>Minimal Pemesanan</td>
		<td>Tentang Produk</td>
		<td colspan="3">Aksi</td>
	</tr>
	<?php foreach($tampil as $row): ?>
		<tr>
			<td><?=$row->NM_PRODUK;?></td>
			<td><?=$row->BERAT_PRODUK;?></td>
			<td><?=$row->MIN_PESAN;?></td>
			<td><?=$row->DES_PRODUK;?></td>
		</tr>
	<?php endforeach; ?>
	<?php else: ?>
		tidak ada data
	<?php endif;?>
</table>