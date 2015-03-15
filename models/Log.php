<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_log".
 *
 * @property integer $id
 * @property string $created_at
 * @property integer $owner_id
 * @property integer $level
 * @property string $message
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['owner_id', 'level'], 'integer'],
            [['message'], 'string']
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
            'owner_id' => 'Owner ID',
            'level' => 'Level',
            'message' => 'Message',
        ];
    }
}
