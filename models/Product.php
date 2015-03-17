<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property integer $category_id
 * @property integer $active
 * @property integer $image_id
 * @property string $external_id
 * @property integer $buy_counter
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price'], 'number'],
            [['sort'], 'integer'],
            [['category_id', 'active', 'image_id', 'buy_counter'], 'integer'],
            [['name'], 'string', 'max' => 512],
            [['external_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'active' => 'Active',
            'image_id' => 'Image ID',
            'external_id' => 'External ID',
            'buy_counter' => 'Buy Counter',
        ];
    }

    public function getImage($x,$y)
    {
        // $m = new Media;
        return Media::getUrlFix( "image", $this->image_id, $x,$y);
    }

    public static function getForCat($id, $orderBy = 'sort', $orderType = "ASC")
    {
        return self::find()->where(['category_id'=>$id, 'active'=>1])->orderBy("$orderBy $orderType")->all();
    }
}
