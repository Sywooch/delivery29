<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_delivery_zone".
 *
 * @property integer $id
 * @property string $name
 * @property double $delivery_price
 * @property integer $active
 */
class DeliveryZone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_delivery_zone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_price'], 'number'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'delivery_price' => 'Delivery Price',
            'active' => 'Active',
        ];
    }

    public static function getZones()
    {
        $zone = self::find()->where(['active'=>1])->all();
        return $zone;
    }
}
