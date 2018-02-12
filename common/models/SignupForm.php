<?php

namespace common\models;

use common\models\User;
use yii\base\Model;
use yii\helpers\BaseUrl;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    const SCENARIO_STANDART_MODE = 'standartMode';
    const SCENARIO_AUTO_MODE = 'autoMode';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_STANDART_MODE] = [
            'email', 
            'password', 
            'role', 
            'request_url', 
            'subject',
        ];
        $scenarios[self::SCENARIO_AUTO_MODE] = [
            'email', 
            'password', 
            'role', 
            'request_url', 
            'subject',
        ];
        return $scenarios;
    }

    //public $username;
    public $email;
    public $password;
    public $verifyCode;

    public $request_url;
    public $subject='Активация аккаунта';

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
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'Указанный E-mail уже используется'],

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


            if (YII_ENV_TEST){
                $user->status = User::STATUS_ACTIVE;
            }else{
                if(Yii::$app->params['user_need_confirm_email']){
                    $user->status = User::STATUS_WAIT;
                    $user->generateEmailConfirmToken();        
                }
                
            }
            
            $user->scenario=$this->scenario;
            $user->role = $this->_defaultRole;
            $user->tarif_id=Tarif::DEFAULT_TARIF;
            $user->generateAuthKey();
            

            if ($user->save()){
                if(Yii::$app->params['user_need_confirm_email']){
                    Yii::$app->mailqueue->compose(['html' => 'user/emailConfirm'], ['model' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->email)
                    ->setSubject($this->subject)
                    ->queue();
                }
                
                return $user;
            }
        }

        return null;
    }
}
