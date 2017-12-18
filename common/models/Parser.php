<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

use common\models\parsers\classes\BaseParser;
use GuzzleHttp\Client; // подключаем Guzzle

/**
 * This is the model class for table "parser".
 *
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property string $host
 * @property string $loader
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Parser extends \yii\db\ActiveRecord
{
    const STATUS_READY = 0;
    const STATUS_HAS_ERROR = 1;
    const STATUS_FIXING = 2;

    //public $testUrls;
    //public $parsActions;
    
    public $parsModel;


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
    public static function tableName()
    {
        return 'parser';
    }

    //=========================================================
    //
    // Validate rules
    //
    //=========================================================
    public function rules()
    {
        return [
            [['name','status','loader_type','example_url','reg_exp'], 'required'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at','type_id'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 128],
            [['description','classCode'], 'safe'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            
        ];
    }

    //=========================================================
    //
    // Labels
    //
    //=========================================================
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'name' => Yii::t('app', 'Name'),
            'loader' => Yii::t('app', 'Loader'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public $statusDescription=[
        self::STATUS_READY=>'Все в проядке',
        self::STATUS_HAS_ERROR=>'Обнаружены ошибки в работе',
        self::STATUS_FIXING=>'Поиск и устранение ошибок',
        
    ];

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================

    public function getType()
    {
        return $this->hasOne(ParserType::className(), ['id' => 'type_id']);
    }

    private $_actions;
    public function getActions()
    {
        if(!isset($this->_actions)){
            $this->_actions=$this->hasMany(ParserAction::className(), ['parser_id' => 'id'])->orderBy(['seq'=>SORT_ASC]);

            if(count($this->_actions->all())==0){
                $this->_actions=[];

                $actionList=new ParserAction();
                $actionList->seq=0;
                $actionList->parser_id=$this->id;
                $actionList->name='ParsList';
                $actionList->status=0;
                $actionList->example_url='111';
                $this->_actions[]=$actionList;   

                $actionItem=new ParserAction();
                $actionItem->seq=1;
                $actionItem->parser_id=$this->id;
                $actionItem->name='ParsItem';
                $actionItem->status=0;
                $actionItem->example_url='222';
                $this->_actions[]=$actionItem;
            }
        }
        return $this->_actions;
    }

    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['parser_id' => 'id']);
    }

    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['id' => 'request_id'])->via('responses');
    }


    public function getResponsesCount()
    {
        return count($this->responses);
    }
    public function getRequestsCount()
    {
        return count($this->requests);
    }
    

    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    /*
    public function beforeValidate()
    {
        if(!parent::beforeValidate())
            return false;

    

    }
    */
    public function afterSave($insert, $changedAttributes)
    {
        
        parent::afterSave($insert, $changedAttributes);

        if(!file_exists($this->classPath)){
            $this->classCode=file_get_contents($this->templateClassPath); 
            $this->classCode=str_replace('{CLASS_NAME}',$this->className,$this->classCode);
            
            if(isset($this->testUrls) && is_array($this->testUrls)){
                foreach ($this->testUrls as $key => $value) {
                     $this->classCode=str_replace('{'.$key.'}',$value,$this->classCode);
                }    
            }

            file_put_contents($this->classPath,$this->classCode);    
        }
        
        
    }
     public function beforeDelete()
     {
        if(file_exists($this->classPath)){
            unlink($this->classPath);  
        }
          
        return parent::beforeDelete();
     }
    

    
    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================

    //Поиск действующего парсерова по URL
    public static function findByUrl($url)
    {
        $model= self::find()->where('SUBSTRING(\''.$url.'\' ,reg_exp) IS NOT NULL');
        //$model->andWhere(['status'=>Parser::STATUS_READY]);
        
        return $model->one();

    }

    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName(){
        return Lookup::item('PARSER_STATUS',$this->status);
    }
    public function getStatusList(){
        return Lookup::items('PARSER_STATUS');
    }

    public function getLoaderName(){
        return Lookup::item('LOADER_TYPE',$this->loader_type);
    }
    public function getLoaderList(){
        return Lookup::items('LOADER_TYPE');
    }

    public function getHostName(){
        $host=parse_url($this->example_url, PHP_URL_HOST);
        $host=str_replace('www.', '', $host);
        return $host;
    }



    private $_className;
    public function getClassName(){
        if(!isset($this->_className)){
            $class=$this->hostName;
            $class=str_replace('.', '-', $class);

            $class=str_replace('0', 'Zero', $class);
            $class=str_replace('1', 'One', $class);
            $class=str_replace('2', 'Two', $class);
            $class=str_replace('3', 'Three', $class);
            $class=str_replace('4', 'Four', $class);
            $class=str_replace('5', 'Five', $class);
            $class=str_replace('6', 'Six', $class);
            $class=str_replace('7', 'Seven', $class);
            $class=str_replace('8', 'Eight', $class);
            $class=str_replace('9', 'Nine', $class);

            $className='';
            foreach (explode('-', $class) as $key => $value) {
                $className.=ucfirst($value);
            }
            $className.='_'.$this->typeName;    

            $this->_className=$className;
        }
        
        return $this->_className;
    }


    public static function getClassDir()
    {   
        return  Yii::getAlias('@common/models/parsers/');
    }
    public function getClassPath()
    {   
        return  $this->classDir.$this->className.'.php';
    }
    public function getTemplateClassPath()
    {   
        return  $this->classDir.'/templates/'.$this->typeName.'.php';
    }

    public function getTypeName()
    {
        return $this->type->name;
    }

    public function getTypeList()
    {
        return ArrayHelper::map(ParserType::find()->all(),'id','name');
    }

    private $_code;
    public function getClassCode()
    {   
        if(!isset($this->_code)){
            
            $this->_code=file_get_contents($this->classPath);    
        }
        return $this->_code;
    }
    public function setClassCode($value)
    {   
        $this->_code=$value;
    }

    public function getExportData(){
        $data=$this->toArray();
        $data['actions']=[];
        foreach ($this->actions as $key => $action) {
            $data['actions'][]=$action->toArray();
        }
        return $data;
    }

    public function getErrorSummary()
    {
        $summary=$this->statusDescription[$this->status];
        if($this->hasErrors()){
            //$summary=$this->statusDescription[self::STATUS_HAS_ERROR];
            foreach ($this->errors as $key => $errors) {
                foreach ($errors as $errorCode){
                    $error = new Error();
                    $error->code=$errorCode;
                    $summary.=': '.$key.' - '.$error->msg.'; ';
                }
            }
        }
        return $summary;
    }




    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/view','id'=>$this->id]);
    }


    //=========================================================
    //
    // Блок вспомагательных методов
    //
    //=========================================================
    

    //Тестирование парсера
    public function test()
    {
        foreach ($this->actions as $action) {
            $file_name='test_action'.$action->name.'.html';

            if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$action->example_url)){
                if($this->testUrl($action->example_url,$file_name)){
                    $action->status=self::STATUS_READY;      
                }else{
                    $action->status=self::STATUS_HAS_ERROR;
                }    
            }else{
                $this->addError($action->name,Error::CODE_UNSET_URL);
                $action->status=self::STATUS_HAS_ERROR;
            }
        }

        if($this->hasErrors()){
            $this->status=self::STATUS_HAS_ERROR;
        }else{
            $this->status=self::STATUS_READY;
        }

        $this->err_description=$this->errorSummary;

    }


    public function testUrl($url,$file_name)
    {
        $this->parsModel= BaseParser::loadParser($this->className);
        $this->parsModel->parserAR=$this;
        
        $result=$this->parsModel->testUrl($url,$file_name);
        $this->addErrors($this->parsModel->errors);
        return $result;
    }
}
