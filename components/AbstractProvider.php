<?php
namespace app\components;
use app\models\Order;

abstract class AbstractProvider {
    abstract public function notice( Order $order );
}