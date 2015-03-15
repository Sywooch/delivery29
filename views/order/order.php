<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Заказ нормер <?php echo $order->id?></h1><hr>
			<p>Создан: <?php echo date('d.m H:i:s', strtotime($order->created_at))?></p>
			<p>Контактный телефон: <?php echo $order->tel?></p>
			<p>Адрес доставки: <?php echo $order->address?></p>
			<p>Комментарий: <?php echo $order->comment?></p>

			<h4>Вы заказали:</h4>
			<table class="table">
				<?php
				foreach ( $order->items as $item )
				{
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
			</table>
		</div>
		<div class="col-md-6">
			<p>Тут типа успаяювающий текст что все будет зорошо, вам скоро позвонят и вообще жизнь налаживается</p>
		</div>
	</div>
</div>