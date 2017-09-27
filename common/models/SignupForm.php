<?php

namespace common\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $verifyCode;

    private $_defaultRole;

    /**
     * @param string $defaultRole
     * @param array $config
     */
    public function __construct($defaultRole, $config = [])
    {
        $this->_defaultRole = $defaultRole;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['username', 'filter', 'filter' => 'trim'],
            //['username', 'required'],
            //['username', 'match', 'pattern' => '#^[\w_-]+$#is'],
            //['username', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('app', 'ERROR_USERNAME_EXISTS')],
            //['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            //['verifyCode', 'captcha', 'captchaAction' => 'user/captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'username' => Yii::t('app', 'USER_USERNAME'),
            'email' => Yii::t('app', 'E-mail'),
            'password' => Yii::t('app', 'Password'),
            //'verifyCode' => Yii::t('app', 'Verify code'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            //$user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->role = $this->_defaultRole;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();

            if ($user->save()) {
                /*
                Yii::$app->mailer->compose(['text' => 'user/emailConfirm'], ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->send();
                */
                Yii::$app->mailqueue->compose(['text' => 'user/emailConfirm'], ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject('Email confirmation for ' . Yii::$app->name)
                    ->queue();
                return $user;
            }
        }

        return null;
    }
}
