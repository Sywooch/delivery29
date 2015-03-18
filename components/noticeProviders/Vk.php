<?php
namespace app\components\noticeProviders;
use Yii;
use app\models\Category;
class Vk
{
	public static function notice( $order )
	{
		$text = "";
		$text .= "#".$order->id." ".$order->created_at."\n";
		$text .=  $order->tel."\n";
		$text .=  $order->address."\n";
		$text .=  $order->comment."\n";
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
		$text .=  "Итого без учета доставки: $total \n";
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