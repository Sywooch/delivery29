<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_session".
 *
 * @property integer $id
 * @property string $hash
 * @property string $created_at
 * @property string $ip
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['created_at'], 'safe'],
            [['hash'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hash' => 'Hash',
            'created_at' => 'Created At',
            'ip' => 'Ip',
        ];
    }

    public static function getUserHash()
    {
        $hash = Yii::$app->request->cookies->getValue('session_hash');
        if ( empty($hash) )
        {
            return false;
        }
        else
        {
            return $hash;
        }
    }

    private static $_current = false;
    public static function current()
    {
        if (self::$_current === false)
        {
            self::$_current = self::getSession();
        }
        return self::$_current;
    }

    public static function createSession()
    {
        $s = new self;
        $s->save();
        $s->setUserHash();
        return $s;
    }

    public static function getSession()
    {
        $hash = self::getUserHash();
        if ($hash == false)
        {
            return self::createSession();
        }

        $hashData = explode("%", $hash);

        if (!isset($hashData[0], $hashData[1]))
        {
            return self::createSession();
        }

        $session = self::find()->where(['id'=>$hashData[1]])->one();

        if (!empty($session))
        {
            if ($session->hash == $hashData[0])
            {
                return $session;
            }
            else
            {
                return self::createSession();
            }
        }

    }

    public function genHash()
    {
        return time().md5(time().rand(0,9999));
    }

    public function setUserHash()
    {
        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'session_hash',
            'value' => $this->hash."%".$this->id,
            'expire' => time()+3600*24*30*12*2,
        ]));
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord)
        {
            $this->hash = $this->genHash();
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }
        return parent::beforeSave($insert);
    }
}
