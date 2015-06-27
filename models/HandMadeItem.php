<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_hand_made_item".
 *
 * @property integer $id
 * @property integer $price
 * @property integer $discount
 * @property integer $preview_id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property string $slug
 */
class HandMadeItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_hand_made_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'discount', 'preview_id'], 'integer'],
            [['description', 'short_description'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
            'discount' => 'Discount',
            'preview_id' => 'Preview ID',
            'name' => 'Name',
            'description' => 'Description',
            'short_description' => 'Short Description',
            'slug' => 'Slug',
        ];
    }

    public function getPreview($width,$height)
    {
        return Media::getUrlFix( "image", $this->preview_id, $width,$height);
    }

    public function getUrl()
    {
        return \Yii::$app->urlManager->createUrl(['hand-made/show', 'slug'=>$this->slug]);
    }

    public function getPriceFormatted() {
        return $this->price.'&nbsp;руб';
    }

    public function getOldPriceFormatted()
    {
        $price = $this->price + $this->discount/100*$this->price;
        return $price.'&nbsp;руб';
    }

    public function getDescription()
    {
        return strtr($this->description, ["\n"=>"<br>"]);
    }

    public function getImages() {
        return $this->hasMany(Media::className(), ['id' => 'media_id'])->viaTable('tbl_hand_made_item_image_relation', ['item_id'=>'id']);
    }
}
