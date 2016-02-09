<?php
$all = $angel->rajaongkir->result;

if($all){
?>
<table class="table">
	<tr>
		<th>No Resi</th>
		<th>Servis</th>
		<th>Tanggal Pengiriman</th>
		<th>Asal</th>
		<th>Tujuan</th>
		<th>Status</th>
	</tr>
	<tr>
		<td><?php echo $all->summary->waybill_number; ?></td>
		<td><?php echo $all->summary->service_code; ?></td>
		<td><?php echo tgl_indo_lengkap($all->summary->waybill_date); ?></td>
		<td><?php echo $all->summary->origin; ?></td>
		<td><?php echo $all->summary->destination; ?></td>
		<td><?php echo $all->summary->status; ?></td>
	</tr>
</table>
<br>
<table class="table">
	<tr>
		<th>Pengirim</th>
		<th>Penerima</th>
	</tr>
	<tr>
		<td><?php echo $all->summary->shipper_name; ?></td>
		<td><?php echo $all->summary->receiver_name; ?></td>
	</tr>
	<tr>
		<td><?php echo $all->summary->origin; ?></td>
		<td><?php echo $all->summary->destination; ?></td>
	</tr>
</table>
<br>
<table class="table">
<?php foreach ($all->manifest as $ue) { ?>
	<tr>
		<td><?php echo tgl_indo_lengkap($ue->manifest_date)." ".$ue->manifest_time; ?></td>
		<td><?php echo $ue->city_name; ?></td>
		<td><?php echo $ue->manifest_description; ?></td>
<?php } ?>
</table>
<?php
}
else
{
	echo "Resi Tidak Tersedia.";
}
?>