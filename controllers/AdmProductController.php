<?php
namespace app\controllers;

use app\models\Media;
use app\models\Product;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;

class AdmProductController extends Controller
{
    public $layout = 'admin';
    public $model = "app\models\Product";
    public $baseUrl = "/adm-product";
	public $enableCsrfValidation = false;
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
                if (isset($_POST['x']))
                {
                    echo  $this->render('index', [ 'model'=>$this->model, 'baseUrl'=>$this->baseUrl]);
                }
                else
                {
                    echo $this->render('create', array( 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'success'=>$item->id, 'data'=>$item));
                }
            }
            else
            {
                header("HTTP/1.1 400");
                echo $this->render('create', array( 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'error'=>$item->getErrors(), 'data'=>$item));
            }
        }
        else
        {
            echo $this->render('create', [ 'model'=>$this->model, 'baseUrl'=>$this->baseUrl, 'data'=>$item]);
        }
    }

    public function actionSetPhoto($id, $url) {
        $product = Product::find()->where(['id'=>$id])->one();
        if ($product) {
            if (strpos($url,"http") !== 0) return -1;

            $info = pathinfo($url);
            $fileName = $info['basename'];
            $ext = $info['extension'];
            if (empty($fileName) || empty($ext) || !in_array($ext, ['png','jpg','jpeg',"PNG","JPG","JPEG"])) {
                return -1;
            }

            $data = @file_get_contents($url);
            if (empty($data)) {
                return -1;
            }
            $originFileName = Media::getNewOriginName('image', '_media', $ext);
            file_put_contents( Media::makePath($originFileName),$data);
            $media = new Media;
            $media->type = 'image';
            $media->file = $originFileName;
            $media->save();
            $product->image_id = $media->id;
            $product->save();
        }
    }
}
