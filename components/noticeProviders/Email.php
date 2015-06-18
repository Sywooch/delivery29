<?php
namespace app\components\noticeProviders;
use app\components\AbstractProvider;
use app\models\Order;
use Yii;
class Email extends AbstractProvider
{
	public function notice(Order $order )
	{
        Yii::$app->mail->compose('@app/mail/newOrderNotice', ['order'=>$order, 'deliveryZones'=>\app\models\DeliveryZone::getZones()])
		     ->setFrom('no-reply@dostavka29.ru')
		     ->setTo(\Yii::$app->params['newOrderNoticeEmail'])
		     ->setSubject('Новый заказ #'.$order->id)
		     ->send();
	}
}