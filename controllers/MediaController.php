<?php

namespace app\controllers;

use Yii;
use yii\imagine\Image;
use yii\web\Controller;
use app\models\Media;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class MediaController extends Controller
{

	// public function behaviors()
 //    {
 //        //  return [
 //        //     'access' => [
 //        //         'class' => AccessControl::className(),
 //        //          'denyCallback' => function ($rule, $action) {
 //        //            die("No access");
 //        //          },
 //        //         // 'only' => ['login', 'logout'],
 //        //         'rules' => [
 //        //             [
 //        //                 'allow' => false,
 //        //                 'actions' => ['upload'],
 //        //                 'roles' => ['?'],
 //        //             ],
 //        //         ],
 //        //     ],
 //        // ];
 //    }

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

	public $acceptX = array( 100,200,400,600,700,800,900,300, 500, 1000 );
	public $acceptY	= array( 100,200,400,600,700,800,900,300, 500, 1000 );

	public function getAccept($val, $arVal)
	{
		if (in_array($val, $arVal)) return $val;
		if ( count($arVal) < 2 ) return $arVal[0];
		sort($arVal);
		if ($val > $arVal[ count($arVal) - 1 ]) return $arVal[ count($arVal) - 1 ];
		if ($val < $arVal[ 0 ]) return $arVal[0];

		$d = abs( $arVal[0] - $val );
		for ($i = 1; $i < count($arVal); $i++ )
		{
			$_d = abs( $arVal[$i] - $val );
			if ( $_d < $d )
			{
				$d = $_d;
			}
			else
			{
				return $arVal[$i-1];
			}
		}
		return $arVal[ count($arVal) - 1 ];
	}

	public function normalizeSize(&$x, &$y)
	{
		$x = round($x);
		$y = round($y);
		$x = $this->getAccept($x, $this->acceptX);
		$y = $this->getAccept($y, $this->acceptY);
	}

	public function actionImage($id, $sizeX = 500, $sizeY = 500, $ext = 'jpg')
	{
		$media = Media::find()->where(["id"=>$id])->one();
		if (empty($media) || $media->type != 'image')
		{
			throw new \HttpException(404, "Media not found");
		}

		$this->normalizeSize($sizeX, $sizeY);
		
		// die("asd4");
		// print_r( $media->getSourceName() );
		// print_r($media->getFileName( $sizeX, $sizeY ) );
		// die();
		Image::thumbnail($media->getSourceName(), $sizeX, $sizeY)
    ->save( $media->getFileName( $sizeX, $sizeY, $ext ) , ['quality' => 100]);

		$this->redirect( $media->getUrl( $sizeX, $sizeY, $ext ) );
	}

	public function actionUpload()
	{
		$image = UploadedFile::getInstanceByName('image');
		if (empty($image))
		{
			throw new \HttpException(400, "Empty image");
		}
		$originFileName = Media::getNewOriginName('image', '_media', $image->extension);
		$image->saveAs( Media::makePath( $originFileName ) );
		$media = new Media;
		$media->type = 'image';
		$media->file = $originFileName;
		$media->save();
		echo $media->id;
	}
}