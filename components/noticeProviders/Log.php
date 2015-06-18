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
		$log->message = "New order #{$order->id} was create by IP ".$_SERVER['REMOTE_ADDR'];
		$log->save();
	}
}