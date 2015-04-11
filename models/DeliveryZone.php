<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_delivery_zone".
 *
 * @property integer $id
 * @property string $name
 * @property double $delivery_price
 * @property string $name_to
 * @property integer $active
 */
class DeliveryZone extends ActiveRecord
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
            [['active', 'sort'], 'integer'],
            [['name','name_to'], 'string', 'max' => 255]
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
            'name_to' => 'Доставить в',
            'sort' => 'Сортировка',
        ];
    }

    public static function getZones()
    {
        $zone = self::find()->where(['active'=>1])->all();
        return $zone;
    }

    public static function getActive()
    {
        $zones = self::find()->where(['active'=>1])->orderBy("sort ASC")->all();
        $out = array();
        foreach( $zones as $zone )
        {
            $out[] = $zone->attributes;
        }
        return $out;
    }
}