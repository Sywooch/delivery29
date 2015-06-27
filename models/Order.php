<?php

namespace app\models;

use app\assets\DiscountHelper;
use Yii;
use \app\assets\OrderStatus;
use \app\components\OrderNotice;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_order".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $tel
 * @property string $address
 * @property string $comment
 * @property double $total
 * @property integer $status
 * @property integer $type
 * @property DeliveryZone $zone
 * @property integer $session_id
 */
class Order extends ActiveRecord
{
    const TYPE_FOOD = 1;
    const TYPE_HAND_MADE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['session_id', 'status', 'zone_id'], 'integer'],
            [['total', 'type'], 'number'],
            [['tel'], 'string', 'max' => 255],
            [['address', 'comment'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'tel' => 'Tel',
            'address' => 'Address',
            'comment' => 'Comment',
            'session_id' => 'Session ID',
            'total' => 'Total',
            'status' => 'Status',
            'zone_id' => 'Зона доставки',
        ];
    }

    public function production()
    {
        $total = 0;
        $items = $this->items;
        foreach ($items as $item) 
        {
            $total += $item->count * $item->product->price;
        }
        $this->total = $total;
        $this->status = OrderStatus::CREATED;
        $this->save();
        $this->notice();
    }

    public function notice()
    {
        $x = new OrderNotice;
        $this->created_at = date("Y-m-d H:i:s");
        $x->notice($this);
    }

    public function getItems()
    {
        return $this->hasMany(OrderData::className(), ['order_id'=>'id']);
    }

    /**
     * @return \app\models\DeliveryZone;
     */
    public function getZone()
    {
        return $this->hasOne(DeliveryZone::className(), ['id'=>'zone_id']);
    }

    public function hasManyPlace() {
        if ($this->items) {
            $place = array();
            foreach ($this->items as $item) {

                /**
                 * @var OrderData $item
                 */
                if ($item->type == OrderData::TYPE_FOOD) {
                    if (isset($place[$item->product->category_id]))
                        $place[$item->product->category_id]++;
                    else
                        $place[$item->product->category_id] = 1;
                }
            }
            return count($place) > 1;
        }
        return false;
    }

    public function getDeliveryPrice() {
        $p = $this->zone ? $this->zone->delivery_price : 0;
        if ($this->hasManyPlace()) {
            $p +=  Yii::$app->params['ADD_DELIVERY_PRICE'];
        }
        return $p;
    }

    public function getDeliveryZone() {
        return $this->zone ? $this->zone->name_to : "вникуда";
    }

    /**
     * true - если это 5 заказ от клиента
     */
    public function isPromo5Order() {
        return DiscountHelper::promo5order($this->id);
    }

    public function calcTotal() {
        $total = 0;
        foreach($this->items as $item) {
            /**
             * @var OrderData $item
             */
            $total += $item->product->price * $item->count;
        }
        return $total;
    }
}
