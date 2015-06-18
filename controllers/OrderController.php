<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Product;
use app\models\Session;
use app\models\DeliveryZone;
use app\models\Order;
use app\models\OrderData;

class OrderController extends Controller
{
    public $layout= "order";
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        return $this->render('index', ['deliveryZones'=>DeliveryZone::getZones()]);
    }

    public function actionMake()
    {
        $this->layout = "json";
        if (!empty($_POST['data']))
        {
            $order = new Order;
            $order->attributes = $_POST['data'];
            $order->session_id = Session::current()->id;
            if ($order->validate() && $order->save())
            {
                foreach( $_POST['data']['items'] as $item )
                {
                    $orderData = new OrderData;
                    $orderData->order_id = $order->id;
                    $orderData->item_id = $item['id'];
                    $orderData->count = $item['count'];
                    $orderData->save();
                }
                $order->production();
                return $this->render('json', ['success'=>$order->id]);
            }
            else
            {
                return $this->render('json', ['error'=>$order->getErrors()]);
            }
        }
        else
        {
            return 1;
        }
    }

    public function actionSuccess($id)
    {
        $order = Order::find()->where(['id'=>$id])->one();
        if (!empty($order))
        {
            if ( $order->session_id == Session::current()->id )
            {
                return $this->render('order', ['order'=>$order]);
            }
            else
            {
                return $this->render('notfound');
            }
        }
        else
        {
                return $this->render('notfound');
        }
    }
}
