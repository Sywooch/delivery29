<?php
namespace app\components;

use Yii;

class OrderNotice
{
	private $noticeProviders = [
		"app\\components\\noticeProviders\\Log",
		"app\\components\\noticeProviders\\Email",
		"app\\components\\noticeProviders\\Sms",
		"app\\components\\noticeProviders\\Vk",
	];

	public function notice( $order )
	{
		foreach ($this->noticeProviders as $provider) {
			$provider::notice( $order );
		}
	}
}