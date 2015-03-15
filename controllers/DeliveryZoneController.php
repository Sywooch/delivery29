<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\admin\LoginForm;
use app\models\DeliveryZone;

class DeliveryZoneController extends Controller
{
    public $layout = 'admin';
    public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                 'denyCallback' => function ($rule, $action) {
                    $this->redirect("/admin");
                 },
                // 'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => false,
       
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        
                        'roles' => ['@'],
                    ],
                ],
            ],
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
    	echo $this->render('index');
    }

    public function actionCreate()
    {
        if (isset($_POST['data']))
        {
            $item = new DeliveryZone;
            $item->attributes = ($_POST['data']);
            if ($item->validate() && $item->save())
            {
                echo $this->render('create', array('success'=>$item->id));
            }
            else
            {
                echo $this->render('create', array('error'=>$item->getErrors(), 'data'=>$item));
            }
        }
        else
        {
            echo $this->render('create');
        }
    }

    public function actionDelete( $id )
    {
        $item = DeliveryZone::find()->where(['id'=>$id])->one()->delete();
    }

    public function actionEdit( $id )
    {
        $item = DeliveryZone::find()->where(['id'=>$id])->one();
        if (isset($_POST['data']))
        {
            $item->attributes = ($_POST['data']);
            if ($item->validate() && $item->save())
            {
                echo $this->render('create', array('success'=>$item->id, 'data'=>$item));
            }
            else
            {
                echo $this->render('create', array('error'=>$item->getErrors(), 'data'=>$item));
            }
        }
        else
        {
            echo $this->render('create', ['data'=>$item]);
        }
    }
}
