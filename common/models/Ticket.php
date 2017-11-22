<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ticket".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $category_id
 * @property string $subject
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ticket extends \yii\db\ActiveRecord
{
    const STATUS_OPEN = 0;
    const STATUS_CLOSE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket';
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
            [['subject','firstMessage'], 'required'],
            [['category_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['subject'], 'string', 'max' => 256],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'category_id' => Yii::t('app', 'Category'),
            'subject' => Yii::t('app', 'Subject'),
            'status' => Yii::t('app', 'Status'),
            'firstMessage'=> Yii::t('app', 'Message'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getCategory(){
        return $this->hasOne(TicketCategory::className(), ['id' => 'category_id']);
    }
    public function getOwner(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getMessages()
    {
        return $this->hasMany(TicketMessage::className(), ['ticket_id' => 'id'])->orderBy(['created_at'=>SORT_ASC]);
    }
    public function getMessageCount()
    {
        return $this->hasMany(TicketMessage::className(), ['ticket_id' => 'id'])->orderBy(['created_at'=>SORT_ASC])->count();
    }

    

    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================
    public static function findByAlias($alias)
    {
        return self::findOne(['alias'=>$alias]);
    }
    
    
    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if($insert){
            $this->created_by=Yii::$app->user->id;
        }
        $this->updated_by=Yii::$app->user->id;

        return true;
    }
    


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        //Сохраняю первое сообщение из формы Create
        if($insert){
            if(isset($this->firstMessage)){
                $model=new TicketMessage();
                $model->ticket_id=$this->id;
                $model->message=$this->firstMessage;
                $model->save();
            }

        }
        
    }


    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName()
    {
        return Lookup::item('TICKET_STATUS',$this->status);
    }
    public function getStatusList()
    {
        return Lookup::items('TICKET_STATUS');
    }

    public function getCategoryName()
    {
        return $this->category->name;
    }
    public static function getCategoryList()
    {
        return ArrayHelper::map(TicketCategory::find()->all(),'id','name');
    }

    private $_firstMessage;
    public function getFirstMessage()
    {
        if(!isset($this->_firstMessage)){
            if(isset($this->messages) && count($this->messages)>0){
                $this->_firstMessage=$this->messages[0]->message;
            }
        }
        return $this->_firstMessage;
    }
    public function setFirstMessage($value)
    {
        $this->_firstMessage=$value;
    }
    

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['ticket/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['ticket/create']);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['ticket/update','alias'=>$this->alias]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['ticket/delete','alias'=>$this->alias]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['ticket/view','alias'=>$this->alias]);
    }

    

    //=========================================================
    //
    // Блок вспомагательных методов
    //
    //=========================================================



}
