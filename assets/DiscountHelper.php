<?php
/**
 * Created by PhpStorm.
 * User: iVan
 * Date: 09.05.2015
 * Time: 14:35
 */

namespace app\assets;

use app\models\Order;

/**
 * Class DiscountHelper
 * @package app\assets
 * Расчет скидок к закзам
 */
class DiscountHelper {

    /**
     * Бесплатная доставка каждый 5 заказ
     * @param $orderId
     * @return bool
     */
    public static function promo5order($orderId) {
        $order = Order::find()->where(['id'=>$orderId])->one();
        if ($order)
        {
            $tel = $order->tel;
            $count = Order::find()->where(['tel'=>$tel])->count();
            return $count % 5 == 0;
        }
        else
        {
            return false;
        }
    }
}