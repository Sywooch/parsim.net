<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "response".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $request_id
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Response extends \yii\db\ActiveRecord
{
    const STATUS_READY = 0;
    const STATUS_LOADING = 1;
    const STATUS_LOADING_SUCCESS = 2;
    const STATUS_LOADING_ERROR = 3;
    const STATUS_PARSING = 4;
    const STATUS_PARSING_SUCCESS = 5;
    const STATUS_PARSING_ERROR = 6;
    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'response';
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

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getRequest(){
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
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
            'request_id' => Yii::t('app', 'Request ID'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getContentPath(){
        return Yii::getAlias('@console'.Yii::$app->params['contentFolder']).'/'.$this->request->alias.'.html';
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        //$url=$this->request->request_url;

        //$this->loader=ContentLoader::TYPE_HTML;
        //$this->parser='baseParser';

        return true;
    }

    public function sendData()
    {
        $result=[
            'email'=>false,
            'url'=>false,
        ];

        if($this->status==self::STATUS_PARSING_SUCCESS)
        {
            //Отправка ответа на E-mail
            if(isset($this->request->response_email))
            {   
                
                Yii::$app->mailqueue->compose(['html' => 'response/responseSuccess'], ['model' => $this])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->request->response_email)
                    ->setSubject('Parsing result from ' . Yii::$app->name)
                    ->queue();
            }

            if(isset($this->response_url))
            {
                
            }
        }

        return $result;
    }
    

    
}
