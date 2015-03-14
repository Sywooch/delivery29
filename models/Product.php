<?php
namespace app\models;
class Product extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'tbl_product';
    }

    public function getImage($x,$y)
    {
    	// $m = new Media;
    	return Media::getUrlFix( "image", $this->image_id, $x,$y);
    }

    public function rules()
    {
    	return [
    		 [['name', 'price'], 'required'],
    		 ['name', 'string', 'min' => 4, 'max' => 512],
    		 ['description', 'string', 'min' => 1, 'max' => 5000],
    		 ['price', 'double'],
    		 ['category_id', 'integer'],
    		 ['active', 'integer'],
    		 ['image_id', 'integer'],
    		 ['external_id', 'string', 'min' => 1, 'max' => 255],
		];
    }
}