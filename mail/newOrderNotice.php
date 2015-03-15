<?php 
	echo "#".$order->id." ".$order->created_at."\n";
?>
<br>
<?php 
	echo $order->tel."\n";
?>
<br>
<?php 
	echo $order->address."\n";
?>
<br>
<?php 
	echo $order->comment."\n";
?>
<br>
Состав заказа<br>
========================================<br>
<?php
	$total = 0;
	foreach ( $order->items as $item )
	{
		$total += $item->count * $item->product->price;
		echo $item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price."<br>\n";
	}
?>
========================================<br>
Итого без учета доставки: <?php echo $total?><br>