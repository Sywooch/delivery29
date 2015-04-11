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
 * @property Product $product
 */
class OrderData extends \yii\db\ActiveRecord
{
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
            [['order_id', 'item_id', 'count'], 'integer']
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
            'count' => 'Count',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id'=>'item_id']);
    }
}
