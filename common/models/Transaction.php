<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $order_id
 * @property integer $response_id
 * @property integer $status
 * @property double $amount
 * @property integer $created_at
 * @property integer $updated_at
 */
class Transaction extends \yii\db\ActiveRecord
{
    const TYPE_IN = 0;
    const TYPE_OUT = 1;

    const STATUS_NEW = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 2;
    


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
                //'src'=>'title',
                'dst'=>'alias',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id','order_id','request_id','response_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'required'],
            [['description','alias'], 'string'],
            [['amount'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'order_id' => Yii::t('app', 'Order ID'),
            'response_id' => Yii::t('app', 'Response ID'),
            'status' => Yii::t('app', 'Status'),
            'amount' => Yii::t('app', 'Amount'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================

    //Владелец транзакции
    public function getOwner(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //Прячу все уведомления о недостатке средств
        if($insert && $this->type==Transaction::TYPE_IN && $this->status==Transaction::STATUS_SUCCESS){
            Notification::updateAll(
                ['status' => Notification::STATUS_READED],
                'type='.Notification::TYPE_NEED_PAY.' AND user_id='.$this->user_id.' AND created_at<='.$this->created_at
            );    
        }
        

        
    }

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['transaction/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['transaction/create']);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['transaction/update','alias'=>$this->alias]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['transaction/delete','alias'=>$this->alias]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['transaction/view','alias'=>$this->alias]);
    }


    public static function getStatusList(){
        return [
            self::STATUS_NEW=>'Новая',
            self::STATUS_SUCCESS=>'Успешная',
            self::STATUS_FAIL=>'Неуспешная',
        ];
    }
    public  function getStatusName(){
        return $this->statusList[$this->status];
    }

    public static function getTypeList(){
        return [
            self::TYPE_IN=>'Приход',
            self::TYPE_OUT=>'Расход',
        ];
    }
    public  function getTypeName(){
        return $this->typeList[$this->type];
    }
}
