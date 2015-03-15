<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_category".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $name
 * @property integer $media_id
 * @property integer $active
 * @property integer $sort
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['media_id', 'active', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 1024]
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
            'name' => 'Name',
            'media_id' => 'Media ID',
            'active' => 'Active',
            'sort' => 'Sort',
        ];
    }

    public static function getList()
    {
        return self::find()->where(['active'=>1])->orderBy('sort')->all();
    }
}
