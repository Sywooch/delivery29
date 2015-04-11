<?php
namespace app\components\noticeProviders;
use Yii;
class Email
{
	public static function notice( $order )
	{
        Yii::$app->mail->compose('@app/mail/newOrderNotice', ['order'=>$order, 'deliveryZones'=>\app\models\DeliveryZone::getZones()])
		     ->setFrom('no-reply@dostavka29.ru')
		     ->setTo(\Yii::$app->params['newOrderNoticeEmail'])
		     ->setSubject('Новый заказ #'.$order->id)
		     ->send();
	}
}