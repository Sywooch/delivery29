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
<?php
    $cat = array();
    foreach ($order->items as $item)
    {
        $catId = $item->product->category_id;
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
Итого без учета доставки: <?php echo $total?><br>