<?php
/**
 * @var array $deliveryZones
 */
/**
 * @var \app\models\Order $order
 */
/**
 * @param $zId
 * @param $zoneArray
 * @return float|int
 */
function getZoneById( $zId, $zoneArray )
{
    foreach ($zoneArray as $zone) {
        /**
         * @var \app\models\DeliveryZone $zone;
         */
        if ($zone->id == $zId) {
            return $zone->delivery_price;
        }
    }

    return 0;
}

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
<?php
    $cat = array();
    foreach ($order->items as $item)
    {
        $catId = $item->type == \app\models\OrderData::TYPE_FOOD ?  $item->product->type->category_id : -1;
        if (!empty($cat[$catId]))
        {
            $cat[ $catId ]['items'][] = $item;
        }
        else
        {
            $cat[ $catId ]['id'] = $catId;
            $cat[ $catId ]['items'] = [$item];
        }
    }
?>
Состав заказа<br>
========================================<br>
<?php
	$total = 0;
	foreach ( $cat as $catId=>$category )
	{
        $data = \app\models\Category::find()->where(['id'=>$catId])->one();
        if ( !empty( $data ) )
        {
            echo "Из ".$data->name."<br>\n";
        }
        else
        {
            echo "Из ".$catId." <br>\n";
        }
        foreach ($category['items'] as $item)
        {
            $total += $item->count * $item->product->price;
            echo "\t".$item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price."<br>\n";
        }
	}
?>
========================================<br>
Без учета доставки: <?php echo $total?><br>
Взять с клиента (примерно): <?php echo $total+$order->getDeliveryPrice()?><br>
Зоны доставки:
<?php if ($order->isPromo5Order()):?>
5 заказ доставка бесплатная
<?php endif;?>
<?php
    foreach($deliveryZones as $zone) {
        echo $zone->name." = ".$zone->delivery_price."р<br>";
    }
?>