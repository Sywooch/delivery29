<?php
/**
 * Created by PhpStorm.
 * User: iVan
 * Date: 11.04.2015
 * Time: 17:13
 */

namespace app\assets;


class OrderStatus {
    const IN_PROGRESS = 1;
    const CREATED = 2;
    const DELIVERED = 3;
    const REJECTED = 4;

    private static $rus = [
        self::IN_PROGRESS => 'Создается',
        self::CREATED => 'Новый',
        self::DELIVERED => 'Доставлен',
        self::REJECTED => 'Отменен'
    ];

    public static function getRusName($id) {
        if (array_key_exists($id, self::$rus)) {
            return self::$rus[$id];
        } else {
            return "BAD ORDER STATUS";
        }
    }
}