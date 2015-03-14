<?php
namespace app\models;
use Yii;
class Media extends \yii\db\ActiveRecord
{
    const DS = DIRECTORY_SEPARATOR;
    public $type = 'image';
    public static function tableName()
    {
        return 'tbl_media';
    }

    public function relations()
    {
        return array(
       	);
    }

    public function getSourceName()
    {
    	$rootPath = Yii::$app->params['mediaPath'];
    	$rootPath .= self::DS. $this->file;
    	return $rootPath;
    }

    public function getFileName($x, $y, $ext = 'png')
    {
    	$url = Yii::$app->params['mediaPath'];
        $url .= self::DS.$this->type.self::DS.$this->id.self::DS.intval($x).'x'.intval($y).'.'.$ext;

        if (!is_dir( dirname($url) ))
        {
            mkdir(dirname($url), 0777, true);  
        }

        return $url;
    }

    public function getUrl($x,$y, $ext = 'png')
    {
        $url = Yii::$app->params['mediaUrl'];
        $url .= '/'.$this->type.'/'.$this->id.'/'.intval($x).'x'.intval($y).'.'.$ext;
        return $url."?".time();
    }

    public static function getUrlFix($type, $id, $x, $y, $ext = 'png')
    {
        $url = Yii::$app->params['mediaUrl'];
        $url .= '/'.$type.'/'.$id.'/'.intval($x).'x'.intval($y).'.'.$ext;
        return $url;   
    }


    public static function getNewOriginName($type, $postfix = '_', $ext = "jpg")
    {
        $file =  "origin".self::DS.$type.self::DS.uniqid('a_',true).$postfix.".".$ext;
        return $file;
    }

    public static function makePath($path)
    {
        $rootPath = Yii::$app->params['mediaPath'];
        $p = $rootPath.self::DS.$path;
        if (!is_dir( dirname($p) ))
        {
            mkdir(dirname($p), 0777, true);  
        }
        return $p;
    }

    public static function makeUrl($path)
    {
        $rootPath = Yii::$app->params['mediaUrl'];
        $p = $rootPath.$path;
        return $p;
    }

    public function getImageSmall()
    {
        return $this->getUrl(100,100);
    }

    public function getImageMedium()
    {
        return $this->getUrl(500,500);
    }

    public function getImageBig()
    {
        return $this->getUrl(1000,1000);
    }

    public function getView()
    {
        return array(
            'id' => $this->id,
            'type' => $this->type,
            'data' => $this->getTypeView()
        );
    }

    public function getTypeView()
    {
        switch ($this->type)
        {
            case "image":
                return array(
                    'image_small' => $this->getImageSmall(),
                    'image_medium' => $this->getImageMedium(),
                    'image_big' => $this->getImageBig(),
                );
            break;

            default:
                return array();
        }
    }
}