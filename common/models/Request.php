<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
//use common\models\parsers\classes\BaseParser;
//use common\models\parsers\classes\ContentLoader;


/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $response_id
 * @property string $target_url
 * @property string $aviso_url
 * @property string $loader
 * @property string $parser
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Request extends \yii\db\ActiveRecord
{

    const STATUS_READY = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;

    const SCENARIO_DEMO='demo';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
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
            [['request_url'], 'required'],
            [['request_url','response_url'],'url', 'defaultScheme' => ''],

            [['response_email'], 'email'],
            
            ['response_email', 'required', 'on' => self::SCENARIO_DEMO],

            /*
            ['response_url', 'required', 'when' => function($model) {
                return !isset($model->response_email);
            }],
            */

            [['response_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at','sleep_time'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['request_url', 'response_url'], 'string', 'max' => 512],

            //[['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            //[['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
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
            'response_id' => Yii::t('app', 'Response ID'),
            'request_url' => Yii::t('app', 'Target Url'),
            'response_url' => Yii::t('app', 'Aviso Url'),
            'loader' => Yii::t('app', 'Loader'),
            'parser' => Yii::t('app', 'Parser'),
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

    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['request_id' => 'id']);
    }
    public function getResponseCount()
    {
        return $this->hasMany(Response::className(), ['request_id' => 'id'])->count();
    }

    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================
    public static function findByAlias($alias)
    {
        return Request::findOne(['alias'=>$alias]);
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

        if($this->scenario==self::SCENARIO_DEMO){
            $this->sleep_time=null; //Запросы созданные в демо режиме не актуализируются
            $this->tarif_id=null; //Запросы созданные в демо режиме не тарифицируются
        }

        return true;
    }
    


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            $this->addResponse();
        }
        
    }

    public function addResponse(){
        $response= new Response();

        $response->request_id=$this->id;
        $response->status=Response::STATUS_READY;

        
        $parser=Parser::findByUrl($this->request_url);

        if(isset($parser)){
            $response->parser_id=$parser->id;

            //Ищу соответствующий закрузчих 
            //ToDo фильтр по статусу, загруженности и т.п.
            $loader=Loader::findOne(['type'=>$parser->loader_type]);

            if(isset($loader)){
                $response->loader_id=$loader->id;
            }else{
                $this->regError(Error::CODE_LOADER_NOT_FOUND,'Не найден загрузчик контента для парсера '.$parser->class_name,$parser->id);
                return false;
            }

            if($response->save()){
                $this->status=Request::STATUS_PROCESSING;
                $this->save();
            }

        }else{

            //Регистрирую ошибку 
            $this->regError(Error::CODE_PARSER_NOT_FOUND,'Не найден парсер URL '.$this->request_url);
            return false;
        }
    }

    


    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName()
    {
        return Lookup::item('REQUEST_STATUS',$this->status);
    }
    public function getStatusList()
    {
        return Lookup::items('REQUEST_STATUS');
    }
    public function getFreqName()
    {
        if(!array_key_exists ($this->sleep_time , $this->freqList )){
            return 'N/A';
        }
        return $this->freqList[$this->sleep_time];
    }

    public function getFreqList()
    {
        return [
            ''=>'Не обновлять',
            15=>'Каждые 15 мин.',
            10=>'Каждые 30 мин.',
            60=>'Каждый час',
            120=>'Каждые 2 часа',
            60*6=>'Четыре раза в сутки',
            60*12=>'Два раза в сутки',
            60*24=>'Раза в сутки',
            60*24*15=>'Раза в 15 дней',
            60*24*30=>'Раза в 30 дней',
        ];
    }

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/create']);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['request/update','alias'=>$this->alias]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/delete','alias'=>$this->alias]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/view','alias'=>$this->alias]);
    }

    public function getResponsesUrl(){
        return Yii::$app->urlManager->createUrl(['response/index','request'=>$this->alias]);
    }


    
    

    //=========================================================
    //
    // Блок вспомагательных методов
    //
    //=========================================================
    private function regError($code,$msg,$parser_id=null,$loader_id=null){
        $error=new Error();

        $error->code=$code;
        $error->msg=$msg;
        $error->status=Error::STATUS_NEW;
        $error->request_id=$this->id;
        $error->parser_id=$parser_id;
        $error->loader_id=$loader_id;

        $error->save();
    }

    public function getLoader(){
        $parser=Parser::findByUrl($this->request_url);
        return $parser->loader_type;
    }


}
