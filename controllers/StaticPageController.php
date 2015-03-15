<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Product;
use app\models\Session;

class StaticPageController extends Controller
{
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

    public function getWebDir()
    {
        return \Yii::$app->basePath.DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR."page";
    }

    public function actionIndex($page)
    {
        $page = preg_replace('/[^A-z0-9\-\_]/ui', '', $page);
        $file = $this->getWebDir().DIRECTORY_SEPARATOR.$page.".html";
        if (file_exists($file))
        {
            return $this->render('index', array('data'=>$file) );
        }
        else
        {
            throw new \yii\web\HttpException(404, "Page not found");
        }
    }
}
