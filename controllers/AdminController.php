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
    	echo $this->render('panel', ['data'=>ParamsController::getData()]);
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
