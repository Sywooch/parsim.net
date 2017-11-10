<?php
namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    const SCENARIO_CREATE='create';
    const SCENARIO_UPDATE='update';
    const SCENARIO_LOGIN='login';
    const SCENARIO_REGISTER='register';

    const SCENARIO_ADMIN_CREATE = 'adminCreate';
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate';

    

    const DEFAULT_ADMIN_ID=1;

    const PASSWORD_RESET_TOKEN_EXPIRE = 3600;

    public $avatarInputFile;
    
    public $newPassword;
    public $newPasswordRepeat;

    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
            ['newPassword', 'compare', 'compareAttribute' => 'newPasswordRepeat'],
            
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS')],
            ['email', 'string', 'max' => 255],

            ['phone', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_PHONE_EXISTS')],

            [['status','avatar_id'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

            ['role', 'string', 'max' => 64],
            [['description', 'first_name','last_name', 'phone','avatar_id' ], 'safe'],
            
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN_CREATE] = [
            'email', 
            'status', 
            'role', 
            'newPassword', 
            'newPasswordRepeat',
            'description', 
            'first_name',
            'last_name', 
            'phone',
            'avatar_id'
        ];
        $scenarios[self::SCENARIO_ADMIN_UPDATE] = [
            'email', 
            'status', 
            'role', 
            'newPassword', 
            'newPasswordRepeat',
            'description', 
            'first_name',
            'last_name', 
            'phone',
            'avatar_id'
        ];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            //'username' => Yii::t('app', 'USER_USERNAME'),
            'email' => Yii::t('app', 'E-mail'),
            'first_name' => Yii::t('app', 'First name'),
            'last_name' => Yii::t('app', 'Last name'),
            'status' => Yii::t('app', 'Status'),
            'role' => Yii::t('app', 'Role'),
            'newPassword' => Yii::t('app', 'Password'),
            'newPasswordRepeat' => Yii::t('app', 'Password repeat'),
        ];
    }

    /**
     * @inheritdoc
     */
    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'Image'=>[
                'class' => 'common\behaviors\ImageUploadBehavior',
                'inputFile'=>'avatarInputFile',
                'imagIdField'=>'avatar_id',
                'imageRelation'=>'avatar',
                'previews'=>[
                    'xs'=>['width'=>64,'mode'=>Image::MODE_FILL_WHIT],
                ]
            ],
        ];
    }

    public function getAvatar()
    {
        return $this->hasOne(Image::className(), ['id' => 'avatar_id']);
    }

    public function getTarif()
    {
        return $this->hasOne(Tarif::className(), ['id' => 'tarif_id']);
    }

    public function getMsgCount()
    {
        return $this->hasMany(Notification::className(), ['user_id' => 'id'])->where(['status'=>Notification::STATUS_NEW])->count();
    }

    
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => Yii::t('app', 'Blocked'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
            self::STATUS_WAIT => Yii::t('app', 'Wait'),
        ];
    }

    

    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($key, $type = null)
    {
        return static::findOne(['auth_key' => $key]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($username)
    {
        return static::findOne(['email' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @param integer $timeout
     * @return static|null
     */
    public static function findByPasswordResetToken($token, $timeout)
    {
        if (!static::isPasswordResetTokenValid($token, $timeout)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @param integer $timeout
     * @return bool
     */
    public static function isPasswordResetTokenValid($token, $timeout)
    {
        if (empty($token)) {
            return false;
        }
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $timeout >= time();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    

    public function getFullName(){
        $full_name='';
        
        $full_name=$this->first_name." ".$this->last_name;
        if($full_name==" "){
            $full_name=explode('@',Yii::$app->user->identity->email)[0];
        }
        return $full_name;
    }
    public static function getRoleName(){
        $role_name='guest';
        if(!Yii::$app->user->isGuest){
            $role_name=Yii::$app->user->identity->role;
            
        }
        return $role_name;
    }

    public function getRoles()
    {
        return [
            'admin'=>Yii::t('app','Administrator'),
            'user'=>Yii::t('app','User')
        ];
    }

   

    public function getIsAdmin(){
        $retVal=false;
        if(Yii::$app->user->identity instanceof $this && Yii::$app->user->identity->role==self::ROLE_ADMIN){
            $retVal=true;
        }
        return $retVal;
    }

    public static function getSignupUrl(){
        return Yii::$app->urlManager->createUrl('user/signup');
    }
    public static function getLoginUrl(){
        return Yii::$app->urlManager->createUrl('user/login');
    }
    public static function getLogoutUrl(){
        return Yii::$app->urlManager->createUrl('/user/logout');
    }
    public static function getPasswordRecoveryUrl(){
        return Yii::$app->urlManager->createUrl('user/password-reset-request');
    }
    public static function getProfileUrl(){
        $url=Yii::$app->urlManager->createUrl('user/profile');
        return $url;
    }

    public static function getIndexUrl(){
        return Yii::$app->urlManager->createUrl(['user/index']);
    }

    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['user/update','id'=>$this->id]);
    }

    public function getPayUrl(){
        return Order::getPayUrl();
    }
    public function getBalanseUrl(){
        return Yii::$app->urlManager->createUrl(['user/balanse']);
    }

    


    public function getAvatarImg($options=[]){
        if(isset($this->avatar)){
            return $this->avatar->getImg('xs',['class'=>'img-circle img-responsive','alt'=>$this->fullName]);
        }else{
            return Html::img('/images/placeholder.jpg',['class'=>'img-circle img-responsive','alt'=>$this->fullName]);
        }
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->newPassword)) {
                $this->setPassword($this->newPassword);
            }
            return true;
        }
        return false;
    } 

    public function getBalanse()
    {
        $sum=Yii::$app->db->createCommand('SELECT sum(amount) FROM transaction WHERE user_id='.$this->id)->queryScalar();
        if(!isset($sum)){
            $sum=0;
        }
        return $sum;
    }

    public function getHasMoney()
    {
        return $this->balanse>=$this->tarif->price;
    }
    

}
