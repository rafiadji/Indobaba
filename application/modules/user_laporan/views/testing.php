<?php
	$data = $this->cart->contents();
?>
<?php if($data): ?>
<?php foreach ($this->cart->contents() as $items): ?>
<?php echo $items['name']; ?><br />
<?php echo $items['rowid']; ?>
<?php endforeach; ?>
<br />
Total Harga : 
<?php echo $this->cart->format_number($items['price']); ?>
<br />
ASD :
<?php echo $this->cart->format_number($items['subtotal']); ?>
<?php endif; ?>