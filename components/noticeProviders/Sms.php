<?php
namespace app\components\noticeProviders;
use Yii;
use app\models\Category;
class Sms
{

    /**
     * @param $zId
     * @param $zoneArray
     * @return float|int
     */
    public static function getZoneById( $zId, $zoneArray )
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

	//http://bytehand.com:3800/send?id=<ID>&key=<KEY>&to=<PHONE>&from=<SIGNATURE>&text=<TEXT>
    /**
     * @param \app\models\Order $order
     */
	public static function notice( $order )
	{
		if ( \Yii::$app->params['smsEnable'] != 'Y' )
		{
			return;
		}

        $zones = \app\models\DeliveryZone::getZones();

		$text = "#".$order->id." ".$order->created_at."\n\r";
		$text .= $order->tel."\n\r";
		$text .= $order->address."\n\r";
		$text .= $order->comment."\n\r";
		$total = 0;
        $cat = [];
        foreach ( $order->items as $item )
        {
            $total += $item->count * $item->product->price;
            if (empty($cat[ $item->product->category_id ]))
            {
                $cat[ $item->product->category_id ] = $item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price." руб \n";
            }
            else
            {
                $cat[ $item->product->category_id ] .= $item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price." руб \n\r";
            }
        }
        foreach ($cat as $catId => $items) {
            $c = Category::find()->where(['id'=>$catId])->one();
            if (!empty($c))
            {
                $text .= "Из ".$c->name." \n\r";
            }
            else
            {
                $text .= "Из ".$catId."\n\r";
            }

            $text .= $items;
        }
		$text .= "Итого: ".$total."\n\r";
        $text .= "Взять с клиента: ".($total+$order->getDeliveryPrice())." ".$order->getDeliveryZone()."\n\r";
        foreach ($zones as $zone) {
            /**
             * @var \app\models\DeliveryZone $zone
             */
            if ($order->zone->id != $zone->id) {
                $text .= $zone->name_to.' '.$zone->delivery_price."\n\r";
            }
        }
		$data = [
			"<PHONE>" => urlencode(\Yii::$app->params['noticePhone']),
			"<TEXT>" => urlencode($text),
			"<SIGNATURE>" => "SMS-INFO",
			"<KEY>" => \Yii::$app->params['byteHandKey'],
			"<ID>" => \Yii::$app->params['byteHandID'],
		];
		$tpl = "http://bytehand.com:3800/send?id=<ID>&key=<KEY>&to=<PHONE>&from=<SIGNATURE>&text=<TEXT>";
		$url = strtr($tpl, $data);
		@file_get_contents($url);
	}
}