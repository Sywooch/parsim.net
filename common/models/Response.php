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

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getRequest(){
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }

    public function getLoader(){
        return $this->hasOne(Loader::className(), ['id' => 'loader_id']);
    }

    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================
    public static function findByAlias($alias)
    {
        return Response::findOne(['alias'=>$alias]);
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

        //$url=$this->request->request_url;

        //$this->loader=ContentLoader::TYPE_HTML;
        //$this->parser='baseParser';

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);


        
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

            unlink($this->contentPath);
        }

        return $result;
    }


    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName(){
        return Lookup::item('RESPONSE_STATUS',$this->status);
    }
    public function getStatusList(){
        return Lookup::items('RESPONSE_STATUS');
    }
    public function getResponseTo(){
        $url=$this->request->response_url;
        $email=$this->request->response_email;

        $retVal='';
        if(isset($url) && $url!=''){
            $retVal.=$url.'; ';
        }
        if(isset($email) && $email!=''){
            $retVal.=$email;
        }

        return $retVal;
    }

    public function getContentPath(){
        return Yii::getAlias('@console'.Yii::$app->params['contentFolder']).'/'.$this->request->alias.'.html';
    }

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['response/index']);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['response/view','alias'=>$this->alias]);
    }

    public function getRequestUrl(){
        return $this->request->viewUrl;
    }

    //=========================================================
    //
    // Блок вспомагательных методов
    //
    //=========================================================
    
    public function addTransaction()
    {
        if(isset($this->request->owner)){
            $transaction=new Transaction();
        
            $transaction->type=Transaction::TYPE_OUT;
            $transaction->response_id=$this->id;
            $transaction->request_id=$this->request->id;
            $transaction->user_id=$this->request->owner->id;
            $transaction->amount=-1*$this->request->owner->tarif->price;
            
            $transaction->save();    
        }
    }

    public function regEventContentLoad()
    {
        $this->status=Response::STATUS_LOADING_SUCCESS;
        $this->save();
    }

    public function regData($data)
    {
        $this->json=$data;
        $this->error=null;
        $this->status=Response::STATUS_PARSING_SUCCESS;
        $this->save();

        $this->request->status=Request::STATUS_SUCCESS;
        $this->request->save();

        $this->sendData();

    }

    public function regError($status,$msg)
    {
        $this->json=null;
        $this->error=json_encode($msg);
        $this->status=$status;
        $this->save();

        $this->request->status=Request::STATUS_ERROR;
        $this->request->save();        

    }
    
}
