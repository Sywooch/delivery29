<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Заказ нормер <?php echo  $order->id?></h1><hr>
			<h4>Вы заказали:</h4>
			<table class="table">
				<?php
				$total = $order->zone->delivery_price;
				foreach ( $order->items as $item )
				{
					$total += $item->count*$item->product->price;
				?>	
				<tr>
					<td>
						<?php echo $item->count?> x <?php echo $item->product->name?>	
					</td>
					<td>
						<?php echo $item->count*$item->product->price;?> руб.
					</td>
				</tr>
				<?php 
				}
				?>
				<tr>
					<td>Доставку в <?php echo $order->zone->name_to?></td>
					<td><?php echo $order->zone->delivery_price?> руб.</td>
				</tr>
				<tr>
					<td><b>Итого:</b></td>
					<td><?php echo $total?> руб</td>
				</tr>
			</table>
			<p>Адрес доставки: <?php echo htmlspecialchars( $order->address ) ?></p>
			<p>Контактный телефон: <?php echo htmlspecialchars( $order->tel ) ?></p>
			<p>Комментарий: <?php echo htmlspecialchars( $order->comment ) ?></p>
			<p>Заказ создан: <?php echo date('d.m H:i:s', strtotime($order->created_at))?></p>

		</div>
		<div class="col-md-6">
			<p>Тут типа успаяювающий текст что все будет зорошо, вам скоро позвонят и вообще жизнь налаживается</p>
		</div>
	</div>
</div>