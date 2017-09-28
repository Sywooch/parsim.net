<?php

namespace common\models;

use Yii;
use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

/**
 * Password reset form
 */
class EmailConfirmForm extends Model
{
    /**
     * @var User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param  string $token
     * @param  array $config
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Email confirm token cannot be blank.');
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong Email confirm token.');
        }
        parent::__construct($config);
    }

    /**
     * Confirm email.
     *
     * @return boolean if email was confirmed.
     */
    public function confirmEmail()
    {

        $user = $this->_user;

        if($user->scenario==SignupForm::SCENARIO_AUTO_MODE)
        {
            $password=$user->password_hash;
            $user->setPassword($password);    
        }

        $user->status = User::STATUS_ACTIVE;
        $user->removeEmailConfirmToken();

        if($user->save())
        {   
            if($user->scenario==SignupForm::SCENARIO_AUTO_MODE){
                Yii::$app->mailqueue->compose(['html' => 'user/emailConfirmSuccess'], ['model' => $user,'password'=>$password])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($user->email)
                    ->setSubject('Ваша учетная запись в Parsim NET успешно активирована')
                    ->queue();
            }
            
            return $user;
        }
        return false;
    }
}