<?php
namespace app\components\noticeProviders;
use app\components\AbstractProvider;
use app\models\Order;
use Yii;

class Log extends AbstractProvider
{
	public function notice(Order $order )
	{
		$log = new \app\models\Log;
		$log->level = 9999;
		$log->message = "New order #{$order->id} was create by IP ".(isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "local");
		$log->save();
	}
}
