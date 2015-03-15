<?php
namespace app\models\admin;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError('password', 'Incorrect username or password.');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
        {
                if ($this->validate()) {
                        $user = User::find()->where(['username'=>$this->login])->one();
                        Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30*15 : 0);
                        return true;
                } else {
                        return false;
                }
        }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    private function getUser()
    {
           
        if ($this->_user === false) {
            $this->_user = User::find()->where(['username'=>$this->login])->one();
                        
        }
        return $this->_user;
    }
}