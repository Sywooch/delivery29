<?php

$params = require(__DIR__ . '/params.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            // "<controller:\w+>/<action:\w+>" => "<controller>/<action>",
                // "<action:\w+>" => "site/<action>",
                "media/image/<id:\d+>/<sizeX:\d+>x<sizeY:\d+>.<ext:\w+>" => "media/image",
                [
                    'pattern' => 'zone',
                    'route' => 'static-page',
                    'defaults' => ['page' => "zone"],
                ],
                [
                    'pattern' => 'work',
                    'route' => 'static-page',
                    'defaults' => ['page' => "work"],
                ],
            ],
            // ...
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dHSp48S787dUUy4tsbRpLb7FCVg5O4td',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'user' => [
            'identityClass' => 'app\models\User', // User must implement the IdentityInterface
            'enableAutoLogin' => true,
            // 'loginUrl' => ['user/login'],
            // ...
        ],
        'mail' => [
             'class' => 'yii\swiftmailer\Mailer',
             'transport' => [
                 'class' => 'Swift_SmtpTransport',
                 'host' => 'smtp.yandex.ru',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                 'username' => 'no-reply@dostavka29.ru',
                 'password' => 'q12we34rfv',
                 'port' => '465', // Port 25 is a very common port too
                 'encryption' => 'ssl', // It is often used, check your provider or mail server specs
             ],
         ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
