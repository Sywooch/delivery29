<?php
namespace app\commands;

use yii\console\Controller;
use app\models\Order;

class NoticeController extends Controller
{
    public function actionOrder($id)
    {
        echo "Strart with $id\n";
        $order = Order::find()->where(['id'=>$id])->one();
        if (empty($order))
        {
            die("Order not found");
        }
        $notice = new \app\components\OrderNotice();
        $notice->notice($order);
        echo "Notice ok";
    }
}
