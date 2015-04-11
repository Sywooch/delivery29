<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class HelpController extends Controller
{
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

    public function runAction($id, $params=array()){
        $params = array_merge($_POST, $params);
        parent::runAction($id, $params);
    }

    public function actionHelp() {

        $text = array_key_exists('text', $_POST) ? htmlspecialchars($_POST['text']) : "";
        $name = array_key_exists('name', $_POST) ? htmlspecialchars($_POST['name']) : "";
        $email = array_key_exists('email', $_POST) ? htmlspecialchars($_POST['email']) : "";

        if ($text)
        Yii::$app->mail->compose('@app/mail/helpMail', ['text'=>$text, 'name'=>$name, 'email'=>$email])
            ->setFrom('no-reply@dostavka29.ru')
            ->setTo('stels-cs+dostavkaHelp@ya.ru')
            ->setSubject("Help на dostavka29")
            ->send();
        return json_encode(['status'=>'ok']);
    }
}