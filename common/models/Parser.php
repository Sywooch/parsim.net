<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

use common\models\parsers\classes\BaseParser;
//use GuzzleHttp\Client; // подключаем Guzzle
use yii\httpclient\Client;

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
    const STATUS_NEW = 3;
    const STATUS_READY = 0;
    const STATUS_HAS_ERROR = 1;
    const STATUS_FIXING = 2;

    const TYPE_PRODUCT = 1;

    //public $testUrls;
    //public $parsActions;
    
    //public $parsModel;


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
            [['name','status','loader_type','reg_exp'], 'required'],
            [['ActionsArray'],'validateAction', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at','type_id'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 128],
            [['description','classCode','ActionsArray'], 'safe'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            
        ];
    }
    public function validateAction($attribute, $params, $validator)
    {
        if (is_array($this->$attribute) && count($this->$attribute)==0 ) {
            $this->addError($attribute, 'Небходимо добавить хотя бы одно действие');
        }else{
            $models=[];
            foreach ($this->$attribute as $key => $action) {
                $model=new ParserAction();
                if(isset($action['id']) && $action['id']!=''){
                    $model=ParserAction::findOne($action['id']);
                }
                
                //$model->load($action);
                //$model->parser_id=$this->id;
                $model->name=$action['name'];
                $model->selector=$action['selector'];
                $model->status=$action['status'];
                $model->example_url=$action['example_url'];

                $models[]=$model;
                
                if(!$model->validate()){

                    //$this->addError($attribute, 'Ошибка заполнения полей в действии '.$model->name);      
                    $this->addError($attribute, 'Ошибка заполнения полей в действии '.$model->name);      
                }
            }
            $this->actionsArray=$models;
        }
        
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

    
    public function getActions()
    {
        return $this->hasMany(ParserAction::className(), ['parser_id' => 'id'])->orderBy(['seq'=>SORT_ASC]);
        
        
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

        
        foreach ($this->actionsArray as $key => $newAction) {
            $newAction->parser_id=$this->id;
            $newAction->save();
        }

        $toRemove=[];
        $addToRemove=true;
        foreach ($this->actions as $oldAction){
            foreach ($this->actionsArray as $key => $newAction) {
                if($oldAction->id==$newAction->id){
                    $addToRemove=false;
                    continue;
                }
            }
            if($addToRemove){
                $toRemove[]=$oldAction;
            }
            $addToRemove=true;
        }
        foreach ($toRemove as $oldAction) {
            $oldAction->delete();
        }



        //Создаю из шаблона класс парсера
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
    private $_actions;
    public function getActionsArray(){
        if(!isset($this->_actions)){
            $this->_actions=$this->actions;
        }
        return $this->_actions;
    }
    public function setActionsArray($value){
        $this->_actions=$value;
    }



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
        $host=parse_url($this->exampleUrl, PHP_URL_HOST);
        $host=str_replace('www.', '', $host);
        return $host;
    }

    public function getExampleUrl(){
        return $this->actions[0]->example_url;
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
    public function getContentDir()
    {   
        return  $this->classDir.'/content/'.$this->className.'/';
    }

    public function getTypeName()
    {
        return $this->type->name;
    }

    public function getTypeList()
    {
        return ArrayHelper::map(ParserType::find()->where(['status'=>ParserType::STATUS_ENABLED])->all(),'id','name');
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
        $summary='';//$this->statusDescription[$this->status];
        if($this->hasErrors()){
            
            foreach ($this->errors as $key => $errors) {
                foreach ($errors as $errorCode){
                    $error = new Error();
                    $error->code=$errorCode;
                    $summary.=$key.' - '.$error->msg.PHP_EOL;
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
    public static function getCreateUrl($url=null)
    {
        return Yii::$app->urlManager->createUrl(['parser/create','url'=>$url]);
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
        $results=[];
        foreach ($this->actions as $action) {
            $file_name='test_action'.$action->name.'.html';

            if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$action->example_url)){
                
                $this->testUrl($action->example_url,$file_name);
                
            }else{

                $this->addError($action->name,Error::CODE_UNSET_URL);
                //$action->status=self::STATUS_HAS_ERROR;
            }
        }

        if($this->hasErrors()){
            $this->status=self::STATUS_HAS_ERROR;
        }else{
            $this->status=self::STATUS_READY;
        }

        //$this->err_description=$this->errorSummary;

    }


    public function testUrl($url,$file_name)
    {
        $parsModel= BaseParser::loadParser($this->className);
        $parsModel->parserAR=$this;

        $data=$parsModel->testUrl($url,$file_name);
        if($data==false){
            $this->addErrors( $parsModel->errors );
        }

        return $data;
    }

    public function sendToTestEmail($email)
    {
        foreach ($this->actions as $key => $action) {

            $file_name='test_action'.$action->name.'.html';
            $data=$this->testUrl($action->example_url,$file_name);

            if($data){
                $response=new Response();
                $response->targetUrl=$action->example_url;
                $response->json=$data;

                Yii::$app->mailqueue->compose(['html' => 'response/responseSuccess'], ['model' => $response,'createUrl'=>Yii::$app->urlManager->createAbsoluteUrl(['/request/create'])])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($email)
                ->setSubject('Parsing result from ' . Yii::$app->name)
                ->send(); 
            }else{
                //$this->addErrors($this->errors);
            }
        }

        if($this->hasErrors()){
            return false;
        }
        return true;

    }

    public function sendToTestUrl($url)
    {
        foreach ($this->actions as $key => $action) {

            $file_name='test_action'.$action->name.'.html';
            $data=$this->testUrl($action->example_url,$file_name);

            if($data){
                $client = new Client();
                $response = $client->createRequest()
                    ->setMethod('post')
                    ->setUrl($url)
                    ->setData(['data' => json_encode(['data'=>$data],JSON_UNESCAPED_UNICODE)])
                    ->send();
                if ($response->isOk) {
                    $response_id = $response->data['id'];
                }else{
                     $this->addError('HttpClient','Ошибка отправки данных');
                }
            }else{
                //$this->addErrors($this->errors);
            }
        }

        if($this->hasErrors()){
            return false;
        }
        return true;

    }

}
