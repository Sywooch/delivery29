<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order_data".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $count
 * @property Product|HandMadeItem $product
 * @property integer $type
 */
class OrderData extends \yii\db\ActiveRecord
{
    const TYPE_FOOD = 1;
    const TYPE_HAND_MADE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id', 'count', 'type'], 'integer'],
            [['type'], 'default', 'value' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'item_id' => 'Item ID',
            'type' => 'Type',
            'count' => 'Count',
        ];
    }

    public function getProduct()
    {
        switch ($this->type) {
            case self::TYPE_HAND_MADE:
                return $this->hasOne(HandMadeItem::className(), ['id'=>'item_id']);
            default:
                return $this->hasOne(Product::className(), ['id'=>'item_id']);
        }
    }
}
