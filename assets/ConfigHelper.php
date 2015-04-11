<?php
/**
 * Created by PhpStorm.
 * User: iVan
 * Date: 11.04.2015
 * Time: 18:33
 */

namespace app\assets;


class ConfigHelper {
    /**
     * Возарвщяет дополнительную стоимость при доставке из разных ресторанов
     * @return float Дополнительную стоипость при доствек из разных ресторанов
     */
    public static function getAddDeliveryPrice() {
       return \Yii::$app->params['ADD_DELIVERY_PRICE'];
    }
}