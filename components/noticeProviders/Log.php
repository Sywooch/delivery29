<?php
namespace app\components\noticeProviders;
use Yii;

class Log
{
	public static function notice( $order )
	{
		$log = new \app\models\Log;
		$log->level = 9999;
		$log->message = "New order #{$order->id} was create by IP ".(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "local");
		$log->save();
	}
}
