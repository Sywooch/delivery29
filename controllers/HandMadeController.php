<?php

namespace app\controllers;

use app\models\HandMadeItem;
use app\models\Order;
use app\models\Session;

class HandMadeController extends \yii\web\Controller
{
    public $layout = 'hand-made';
    public function actionIndex()
    {
        return $this->render('index', ['items'=>HandMadeItem::find()->all()]);
    }

    public function actionShow($slug) {
        $item = HandMadeItem::find()->where(['slug'=>$slug])->one();
        if ($item) {
            return $this->render('item', ['item'=>$item]);
        } else {
            return $this->render('404');
        }
    }

    public function actionOrder($id) {
        $order = Order::find()->where(['id'=>$id])->one();
        if ($order) {
            if ( $order->session_id == Session::current()->id )
            {
                return $this->render('order', ['order'=>$order]);
            }
            else
            {
                return $this->render('../order/notfound');
            }
        } else {
            return $this->render("../order/notfount.php");
        }
    }
}
