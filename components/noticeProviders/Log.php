<?php
namespace app\components\noticeProviders;
use Yii;

class Log
{
	public static function notice( $order )
	{
		$log = new \app\models\Log;
		$log->level = 9999;
		$log->message = "New order #{$order->id} was create by IP ".$_SERVER['REMOTE_ADDR'];
		$log->save();
	}
}