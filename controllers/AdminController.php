<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\admin\LoginForm;
use app\models\Product;

class AdminController extends Controller
{
    public $layout = 'admin';
    public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                 'denyCallback' => function ($rule, $action) {
                    echo $this->render("login");
                 },
                // 'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout','index','create', 'delete', '*'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['*'],
                        'roles' => ['?']
                    ]
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
    	echo $this->render('panel');
    }

    public function actionCreate()
    {
        if (isset($_POST['data']))
        {
            $product = new Product;
            $product->attributes = ($_POST['data']);
            if ($product->validate() && $product->save())
            {
                echo $this->render('ProductForm', array('success'=>$product->id));
            }
            else
            {
                echo $this->render('ProductForm', array('error'=>$product->getErrors(), 'data'=>$_POST['data']));
            }
        }
        else
        {
            echo $this->render('ProductForm');
        }
    }

    public function actionDelete( $id )
    {
        $product = Product::find()->where(['id'=>$id])->one()->delete();
        echo $this->render('json', array('status'=>'ok'));
    }

    public function actionLogin(  )
    {
        $loginForm = new LoginForm();
        $loginForm->login = $_POST['email'];
        $loginForm->password = $_POST['password'];
        $loginForm->rememberMe = !empty($_POST['rememberMe']) ? true : false;
        if ($loginForm->login())
        {
            echo $this->render('panel');
        }
        else
        {
            // $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
            echo $this->render('login', array('message'=>'Incorrect login or password '));
        }
    }
}
