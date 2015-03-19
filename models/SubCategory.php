<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_subcategory".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $active
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_subcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['active'], 'integer'],
            [['name'], 'string', 'max' => 512]
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
            'active' => 'Active',
        ];
    }
}
