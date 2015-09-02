<?php
/* @var $this yii\web\View */
$this->title = 'Доставка Архагельск';
/**
 * @var \app\models\Order $order
 */
?>
<script src="<?php echo \Yii::$app->urlManager->createUrl(['/js/order-helper.js'])?>"></script>
<div class="container">
	 <h1>Заказ нормер <?php echo  $order->id?></h1><hr>
	<div class="row">
		<div class="col-md-6">
			<h4>Вы заказали:</h4>
			<table class="table">
				<?php
				$total = $order->getDeliveryPrice();
				foreach ( $order->items as $item )
				{
                    /**
                     * @var \app\models\OrderData $item
                     */
					$total += $item->count*$item->product->price;
				?>	
				<tr>
					<td>
                        <?php if ($item->type == \app\models\OrderData::TYPE_FOOD) {?>
                            <img class="basket-category-icon" src="/img/categorys/<?php echo $item->product->category_id?>.png" alt="1"> <?php echo $item->count?> x <?php echo $item->product->name?>
					    <?php } else { ?>
                            <img class="basket-category-icon" src="/img/categorys/no.png" alt="1"> <?php echo $item->count?> x <?php echo $item->product->name?>
                        <?php } ?>
                    </td>
					<td>
						<?php echo $item->count*$item->product->price;?> руб.
					</td>
				</tr>
				<?php 
				}
				?>
				<tr>
					<td>Доставку <?php echo $order->zone->name_to?></td>
					<td><?php echo $order->zone->delivery_price?> руб.</td>
				</tr>
                <?php if($order->hasManyPlace()): ?>
                    <tr>
                        <td>Доставку из разных ресторанов</td>
                        <td><?php echo \app\assets\ConfigHelper::getAddDeliveryPrice()?> руб.</td>
                    </tr>
                <?php endif;?>
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
			<?php if($order->isPromo5Order()): ?>
            <!--<noindex>
            <div class="panel panel-default">
                <div class='panel-body'>
                    <h2 style="margin-top:0">Это ваш 5 заказ</h2>
                    <p>Доставка этого заказа бесплатна, вы платите толкьо за то, что заказали</p>
                </div>
            </div>
            </noindex>-->
            <?php endif;?>
            <div class="panel panel-default">
				<div class='panel-body'>
					<h2 style="margin-top:0">Что дальше?</h2>
					<ul>
						<li>
							Дождитесь звонка нашего опаратора
						</li>
						<li>Если оператор не перезвонил через 10 минут позвоните по номеру +7&nbsp;911&nbsp;575&nbsp;56&nbsp;85<br><a href="<?php echo \Yii::$app->urlManager->createUrl(['static-page/index','page'=>'work']);?>">режим работы службы доставки</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
