<?php

namespace common\models;


use Yii;
use yii\helpers\Html;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "error".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $request_id
 * @property integer $response_id
 * @property integer $loader_id
 * @property integer $parser_id
 * @property integer $status
 * @property string $msg
 */
class Error extends \yii\db\ActiveRecord
{
    const CODE_UNKNOW_ERROR = 100;
    const CODE_UNSET_URL = 101;
    const CODE_UNSET_SELECTOR = 102;
    const CODE_REQUEST_CANNOT_CREATE_RESPONSE = 102; //+

    const CODE_PARSER_NOT_FOUND = 200;              //+
    const CODE_PARSER_ACTION_NOT_FOUND = 201;
    const CODE_PARSER_FOUND_MANY_ACTIONS = 203;
    const CODE_PARSER_CONTENT_NOT_FOUND = 204;

    const CODE_PARSING_ERROR = 202;
    const CODE_LOADER_NOT_FOUND = 300;              //+
    const CODE_LOADING_ERROR = 301;

    const CODE_IMPORT_ERROR = 401;
    
    const STATUS_NEW = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_TESTING = 2;
    const STATUS_FIXED = 3;

    private $messages=[
        self::CODE_UNKNOW_ERROR=>'Неизвестная ошибка',
        self::CODE_UNSET_URL=>'Не задан URL',//???
        self::CODE_UNSET_SELECTOR=>'Не задан селекторр',//???
        self::CODE_REQUEST_CANNOT_CREATE_RESPONSE=>'Ошибка создания ответа',
        self::CODE_PARSER_NOT_FOUND=>'Не найден парсер',
        self::CODE_PARSER_ACTION_NOT_FOUND=>'Не удалось определить действие парсера',
        self::CODE_PARSER_FOUND_MANY_ACTIONS=>'Неоднозначное определение действия парсера (нашел несколько вариантов)',
        self::CODE_PARSER_CONTENT_NOT_FOUND=>'Не найден контент для парсинга',
        self::CODE_PARSING_ERROR=>'Ошибка парсинга',
        self::CODE_LOADER_NOT_FOUND=>'Не найден загрузчик контента',
        self::CODE_LOADING_ERROR=>'Ошибка загрузки контента',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'error';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
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
            [['request_id', 'response_id', 'loader_id', 'parser_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['alias'], 'string', 'max' => 16],
            [['loader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Loader::className(), 'targetAttribute' => ['loader_id' => 'id']],
            [['parser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parser::className(), 'targetAttribute' => ['parser_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
            [['response_id'], 'exist', 'skipOnError' => true, 'targetClass' => Response::className(), 'targetAttribute' => ['response_id' => 'id']],
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
            'response_id' => Yii::t('app', 'Response ID'),
            'loader_id' => Yii::t('app', 'Loader ID'),
            'parser_id' => Yii::t('app', 'Parser ID'),
            'status' => Yii::t('app', 'Status'),
            'msg' => Yii::t('app', 'Msg'),
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getParser(){
        return $this->hasOne(Parser::className(), ['id' => 'parser_id']);
    }
    public function getAction(){
        return $this->hasOne(ParserAction::className(), ['id' => 'action_id']);
    }

    public function getRequest(){
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
    public function getResponse(){
        return $this->hasOne(Response::className(), ['id' => 'response_id']);
    }
    public function getLoader(){
        return $this->hasOne(Loader::className(), ['id' => 'loader_id']);
    }

    public function getTransaction(){
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }

    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================
    public static function findByAlias($alias)
    {
        return Error::findOne(['alias'=>$alias]);
    }

    public static function getCountNew()
    {
        return Error::find()->where(['status'=>Error::STATUS_NEW])->count();
    }

    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            if(isset(Yii::$app->params['errorEmail'])){
               /* 
               Yii::$app->mailqueue->compose(['html' => 'error/view'], ['model' => $this,'adminUrl'=>Yii::$app->urlManagerBackEnd->createUrl(['/error/index'])])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo(Yii::$app->params['errorEmail'])
                    ->setSubject('Parsing error registred')
                    ->queue();
                */
            }    
        }

        /*
        if($this->status==self::STATUS_FIXED && isset($this->request)){
            $this->request->status=Request::STATUS_READY;
            $this->request->save();
        }
        */
    }

    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName(){
        return Lookup::item('ERROR_STATUS',$this->status);
    }
    public function getStatusList(){
        return Lookup::items('ERROR_STATUS');
    }

    public function getHtmlInfo(){
        $info=$this->msg.'; ';
        if(isset($this->parser)){
            $info.='Parser ID: <a href="'.$this->parser->updateUrl.'">'.$this->parser->alias.'</a><br>';
        }
        if(isset($this->response)){
            $info.='Response ID: <a href="'.$this->response->viewUrl.'">'.$this->response->alias.'</a><br>';
        }
        if(isset($this->request)){
            $info.='Request ID: <a href="'.$this->request->updateUrl.'">'.$this->request->alias.'</a><br>';
            $info.='URL: <a href="'.$this->request->request_url.'" target="blank">'.$this->request->request_url.'</a><br>';
        }

        return $info;
    }

    public function getMsg(){
        if(array_key_exists ( $this->code , $this->messages )){
            return $this->messages[$this->code];
        }else{
            return $this->code;
        }
        
    }
    

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['error/index']);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['error/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['error/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['error/view','id'=>$this->id]);
    }

    public function getParserLink($options=[]){
        $model=$this->parser;
        if(isset($model)){
            return Html::a($model->name,$model->viewUrl,$options);
        }
        return '';
    }
    public function getLoaderLink($options=[]){
        $model=$this->loader;
        if(isset($model)){
            return Html::a($model->typeName,$model->viewUrl,$options);
        }
        return '';
    }
    public function getRequestLink($options=[]){
        $model=$this->request;
        if(isset($model)){
            return Html::a($model->alias,$model->viewUrl,$options);
        }
        return '';
    }

    public function getResponseLink($options=[]){
        $model=$this->response;
        if(isset($model)){
            return Html::a($model->alias,$model->viewUrl,$options);
        }
        return '';
    }
    

    //=========================================================
    //
    // Блок вспомагательных методов
    //
    //=========================================================
    
}
