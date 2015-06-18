<?php
namespace app\components\noticeProviders;
use app\components\AbstractProvider;
use app\models\DeliveryZone;
use app\models\Order;
use Yii;
use app\models\Category;
class Vk extends AbstractProvider
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
             * @var DeliveryZone $zone;
             */
            if ($zone->id == $zId) {
                return $zone->delivery_price;
            }
        }

        return 0;
    }


    /**
     * @param \app\models\Order $order
     */
    public function notice(Order $order )
	{
        $zones = DeliveryZone::getZones();
		$text = "";
		$text .= "#".$order->id." ".$order->created_at."\n";
		$text .=  $order->tel."\n";
		$text .=  $order->address."\n";
		$text .=  $order->comment."\n";
        if ($order->isPromo5Order())
            $text .= "5 заказ доставка - басплатная \n";
		$text .= "Состав заказа\n";
		$text .= "========================================\n";
		$total = 0;
		$cat = array();
		foreach ( $order->items as $item )
		{	
			$total += $item->count * $item->product->price;
			if (empty($cat[ $item->product->category_id ]))
			{
				$cat[ $item->product->category_id ] = $item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price." руб \n";
			}
			else
			{
				$cat[ $item->product->category_id ] .= $item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price." руб \n";
			}
		}
		foreach ($cat as $catId => $items) {
			$c = Category::find()->where(['id'=>$catId])->one();
			if (!empty($c))
			{
				$text .= "Из ".$c->name." \n";
			}
			else
			{
				$text .= "Из ".$catId."\n";
			}
			
			$text .= $items;
		}
		$text .= "========================================\n";
		$text .= "Итого без учета доставки: $total \n";
        $text .= "Взять с клиента: ".($total+$order->getDeliveryPrice())." ".$order->getDeliveryZone()."\n";
        foreach ($zones as $zone) {
            /**
             * @var DeliveryZone $zone
             */
            if ($zone->id != $order->zone->id) {
                $text .= $zone->name_to.' '.$zone->delivery_price."\n";
            }
        }
		self::sendVkMessage($text);
	}

	public static function getUserVkNotice()
	{
		return \Yii::$app->params['vkUserIds'];
	}

	public static function getAccessToken()
	{
		return \Yii::$app->params['vkAccessToken'];
	}

	public static function sendVkMessage($text)
	{
		$method = "messages.send";
		$params = array(
			"user_ids" => self::getUserVkNotice(),
			"message" => urlencode($text),
			"guid" => mb_strlen($text),
			"v" => 5.29,
			"access_token" => self::getAccessToken()
		);
		self::vkRequest($method, $params);
	}

	public static function vkRequest($m, $data)
	{
		$url = "https://api.vk.com/method/".$m;
		$p = array();
		foreach ($data as $key => $value) {
			$p[] = $key."=".($value);
		}
		$url .= "?".implode("&", $p);
		@$x = file_get_contents($url);
		$data = json_decode($x,true);
		if (!empty($data['error']))
		{
			\Yii::error("$x", "Api request");
		}
	}
}