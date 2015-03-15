<?php
namespace app\components\noticeProviders;
use Yii;
class Sms
{
	//http://bytehand.com:3800/send?id=<ID>&key=<KEY>&to=<PHONE>&from=<SIGNATURE>&text=<TEXT>
	public static function notice( $order )
	{
		if ( \Yii::$app->params['smsEnable'] != 'Y' )
		{
			return;
		}
		$text = "#".$order->id." ".$order->created_at."\n\r";
		$text .= $order->tel."\n\r";
		$text .= $order->address."\n\r";
		$text .= $order->comment."\n\r";
		$total = 0;
		foreach ( $order->items as $item )
		{
			$total += $item->count * $item->product->price;
			$text .= $item->count." x ".$item->product->name." (".$item->product->id.") ".$item->product->price."\n\r";
		}
		$text .= "=".$total;

		$data = [
			"<PHONE>" => urlencode(\Yii::$app->params['noticePhone']),
			"<TEXT>" => urlencode($text),
			"<SIGNATURE>" => "SMS-INFO",
			"<KEY>" => \Yii::$app->params['byteHandKey'],
			"<ID>" => \Yii::$app->params['byteHandID'],
		];
		$tpl = "http://bytehand.com:3800/send?id=<ID>&key=<KEY>&to=<PHONE>&from=<SIGNATURE>&text=<TEXT>";
		$url = strtr($tpl, $data);
		file_get_contents($url);
	}
}