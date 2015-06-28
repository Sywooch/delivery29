<?php

namespace app\controllers;

use app\models\HandMadeItem;
use app\models\Media;
use app\models\Order;
use app\models\Session;
use yii\web\HttpException;

class HandMadeController extends \yii\web\Controller
{
    public $layout = 'hand-made';
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest == false) {
            return $this->render('index', ['items'=>HandMadeItem::find()->orderBy(['sort'=>'ASC'])->all()]);
        }
        return $this->render('index', ['items'=>HandMadeItem::find()->where(['active'=>1])->orderBy(['sort'=>'ASC'])->all()]);
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

    public function actionEdit($id=false) {
        if ($id) {
            $item = HandMadeItem::find()->where(['id'=>$id])->one();
            return $this->render('edit',['item'=>$item, 'new'=>false]);
        } else {
            $item = new HandMadeItem();
            $item->save();
            return $this->render('edit',['item'=>$item, 'new'=>true]);
        }
    }

    public function actionSaveItem() {
        $data = $_POST;
        if (empty($data['id'])) {
            throw new \Exception("Id not found", 400);
        }
        $id = (int) $data['id'];
        $item = HandMadeItem::find()->where(['id'=>$id])->one();
        if (empty($item)) {
            throw new \Exception("Item with id not found", 400);
        }
        $item->attributes = $data;
        if ($item->validate() && $item->save()) {
            if (!empty($data['images']) && is_array($data['images'])) {
                $item->unlinkAll('images',true);
                foreach ($data['images'] as $iId) {
                    $image = Media::find()->where(['id'=>$iId])->one();
                    if ($image) {
                        $item->link('images', $image);
                    }
                }
            }
            return \Yii::$app->urlManager->createUrl(['hand-made/edit', 'id'=>$item->id]);
        } else {
            return print_r($item->getErrors());
        }
    }
}
