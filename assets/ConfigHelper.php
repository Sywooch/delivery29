<?php
/**
 * Created by PhpStorm.
 * User: iVan
 * Date: 11.04.2015
 * Time: 18:33
 */

namespace app\assets;


class ConfigHelper
{
    /**
     * Возарвщяет дополнительную стоимость при доставке из разных ресторанов
     * @return float Дополнительную стоипость при доствек из разных ресторанов
     */
    public static function getAddDeliveryPrice()
    {
        return \Yii::$app->params['ADD_DELIVERY_PRICE'];
    }

    /**
     * @return string Емейл для связи с партнерами
     */
    public static function getPartnerEmail()
    {
        return "ad@dostavka29.ru";
    }

    /**
     * @return string СЕО ключевые слова
     */
    public static function getKeywords()
    {
        return "доставка суши архангельск, архангельск доставка пиццы, архангельск доставка еды, доставка архангельск роллы, доставка старфудс архангельск, доставка макдональдс архангельск, доставка комплексных обедов архангельск, доставка обедов архангельск, заказать еду в архангельске, доставка еды в архангельске, доставка пиццы и суши архангельск, доставка в офис архангельск, доставка обедов в офис архангельск, доставка гамбургеров архангельск, заказать макдональдс архангельск, доставка макдак архангельск";
    }

    /**
     * @return string СЕО описание
     */
    public static function getDescription()
    {
        return "Быстрая доставка еды в Архангельске. Заказать Макдональдс и Старфудс с доставкой на дом и в офис по Архангельску.";
    }

    /**
     * @return string Уникальный тег для каждого коомита
     */
    public static function getVer() {
        return 3;
    }

    public static function disableDelivery()
    {
        if (isset(\Yii::$app->params['DISABLE_DELIVERY'])) {
            return \Yii::$app->params['DISABLE_DELIVERY'] == 'Y';
        } else {
            return false;
        }
    }

    public static function getDisableDeliveryText($string)
    {
        if (isset(\Yii::$app->params['DISABLE_DELIVERY_REASON']) && !empty(\Yii::$app->params['DISABLE_DELIVERY_REASON'])) {
            return \Yii::$app->params['DISABLE_DELIVERY_REASON'];
        } else {
            return $string;
        }
    }
}