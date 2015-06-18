<?php
namespace app\components;

use app\models\Order;
use Yii;

class OrderNotice
{
	private $noticeProviders = [
		"app\\components\\noticeProviders\\Log",
		"app\\components\\noticeProviders\\Email",
		"app\\components\\noticeProviders\\Sms",
		"app\\components\\noticeProviders\\Vk",
	];

    private $skipProviders = [];

    public function __construct($skipProviders = []) {
        $this->skipProviders = $skipProviders;
    }

	public function notice( Order $order )
	{
		foreach ($this->noticeProviders as $providerClass) {
            if ( !in_array($providerClass, $this->skipProviders) ) {
                /**
                 * @var AbstractProvider $provider
                 */
                $provider = new $providerClass;
                $provider->notice($order);
            }
        }
	}
}