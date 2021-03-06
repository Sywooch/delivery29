<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;

class ParamsController extends Controller
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


    public static function getData()
    {
        $file = dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'params.json';
        if (file_exists($file))
        {   
            $data = json_decode(file_get_contents($file),true);
            return $data;
        } 
        else
        {
            return array();
        }
    }

    public function saveData($data)
    {
        $file = dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'params.json';
        file_put_contents($file, json_encode($data));
    }

    public function actionIndex()
    {
    	echo $this->render('index', ['data'=>self::getData()]);
    }

    public function actionCreate($name, $value)
    {
       $data = self::getData();
       $data[$name] = $value;
       $this->saveData($data);
    }

    public function actionDelete( $name )
    {
        $data = self::getData();
        unset($data[$name]);
        $this->saveData($data);
    }
}
