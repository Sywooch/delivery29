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
            [['category_id', 'active', 'image_id', 'buy_counter', 'subcategory_id'], 'integer'],
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
            'subcategory_id' => 'Подкатегория',
        ];
    }

    public function getImage($x,$y)
    {
        // $m = new Media;
        return Media::getUrlFix( "image", $this->image_id, $x,$y);
    }

    public function getSubCategory()
    {
        return $this->hasOne(\app\models\SubCategory::className(), ['id'=>'subcategory_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(\app\models\Category::className(), ['id'=>'category_id']);
    }

    private static $subcategoryCache = array();

    public static function getSubategotyName($id)
    {
        if  (empty(self::$subcategoryCache[$id]))
        {
            $cat = \app\models\SubCategory::find()->where(['id'=>$id])->one();
            self::$subcategoryCache[$id] = $cat;
        }
        if (!empty(self::$subcategoryCache[$id]))
        {
            return self::$subcategoryCache[$id]->name;
        }
        else
        {
            return "";
        }
    }


    public static function getForCat($id, $orderBy = 'sort', $orderType = "ASC", $makeSubcategory = false)
    {
        $array = self::find()->where(['category_id'=>$id, 'active'=>1])->orderBy("$orderBy $orderType")->all();
        if (!$makeSubcategory)
        {
            return $array;
        }
        else
        {
            $out = array();
            foreach ($array as $item)
            {
                $out[ $item->subcategory_id ]['items'][] = $item;
            }
            foreach ($out as $key=>&$val)
            {
                $val['id'] = $key;
                $val['name'] = self::getSubategotyName($key);
            }
            return $out;
        }
    }

}
