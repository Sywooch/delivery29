<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;

class AdmProductController extends Controller
{
    public $layout = 'admin';
    public $model = "app\models\Product";
    public $baseUrl = "/adm-product";
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
    	echo $this->render('index', [ 'model'=>$this->model, 'baseUrl'=>$this->baseUrl]);
    }

    public function actionCreate()
    {
        if (isset($_POST['data']))
        {
            $item = new $this->model;
            $item->attributes = ($_POST['data']);
            if ($item->validate() && $item->save())
            {
                echo $this->render('create', array( 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'success'=>$item->id));
            }
            else
            {
                echo $this->render('create', array( 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'error'=>$item->getErrors(), 'data'=>$item));
            }
        }
        else
        {
            echo $this->render('create', ['model'=>$this->model, 'baseUrl'=>$this->baseUrl]);
        }
    }

    public function actionDelete( $id )
    {
        $x = $this->model;
        $item = $x::find()->where(['id'=>$id])->one()->delete();
    }

    public function actionEdit( $id )
    {
        $x = $this->model;
        $item = $x::find()->where(['id'=>$id])->one();
        if (isset($_POST['data']))
        {
            $item->attributes = ($_POST['data']);
            if ($item->validate() && $item->save())
            {
                echo $this->render('create', array( 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'success'=>$item->id, 'data'=>$item));
            }
            else
            {
                echo $this->render('create', array( 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'error'=>$item->getErrors(), 'data'=>$item));
            }
        }
        else
        {
            echo $this->render('create', [ 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'data'=>$item]);
        }
    }
}
