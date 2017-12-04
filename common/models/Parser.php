<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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

    public $listSelector;
    public $pagesSelector;
    public $itemSelector;

    public $listTestUrl;
    public $itemTestUrl;

    public $fillItem;
    public $fillListItem;
    public $fillPage;
    
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

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================

    public function getType()
    {
        return $this->hasOne(ParserType::className(), ['id' => 'type_id']);
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
            
            $this->classCode=str_replace('{URL_HOST}',parse_url($this->example_url, PHP_URL_HOST),$this->classCode);
            $this->classCode=str_replace('{URL_SCHEME}',parse_url($this->example_url, PHP_URL_SCHEME),$this->classCode);

            $this->classCode=str_replace('{LIST_SELECTOR}',$this->listSelector,$this->classCode);
            $this->classCode=str_replace('{ITEM_SELECTOR}',$this->itemSelector,$this->classCode);
            $this->classCode=str_replace('{PAGES_SELECTOR}',$this->pagesSelector,$this->classCode);

            $this->classCode=str_replace('{LIST_TEST_URL}',$this->listTestUrl,$this->classCode);
            $this->classCode=str_replace('{ITEM_TEST_URL}',$this->itemTestUrl,$this->classCode);

            //$this->classCode=str_replace('{FILL_ITEM}',$this->fillItem,$this->classCode);
            //$this->classCode=str_replace('{FILL_LIST_ITEM}',$this->fillListItem,$this->classCode);
            //$this->classCode=str_replace('{FILL_PAGE}',$this->fillPage,$this->classCode);

        }
        
        file_put_contents($this->classPath,$this->classCode);

        self::checkErrors($this->example_url);
        
        
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
    /*
    public static function findByClassName($className)
    {
        return Parser::find()->where(['class_name'=>$className])->one();
    }
    */

    //Поиск действующего парсерова по URL
    public static function findByUrl($url)
    {
        $model= self::find()->where('SUBSTRING(\''.$url.'\' ,reg_exp) IS NOT NULL');
        $model->andWhere(['status'=>Parser::STATUS_READY]);
        /*
        if(count($models)>1){
            //reg error

            return false;
        }*/


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


    public function getClassPath()
    {   
        return  Yii::getAlias('@common/models/parsers/'.$this->className.'.php');
    }
    public function getTemplateClassPath()
    {   
        return  Yii::getAlias('@common/models/parsers/templates/'.$this->typeName.'.php');
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
    public static function CheckErrors($url)
    {
        
        $description="Неизвестная ошибка";
        
        
        //Проверка работы регулярных выражений (на всех парсерах хоста)
        $host=parse_url($url, PHP_URL_HOST);
        $parsers=self::find()->where("example_url LIKE '%".$host."%'")->all();
        
        foreach ($parsers as $key => $parser) {
            $has_error=true;
            //В идеале должна быть одна запись и соответствоват значению $parser->example_url
            $models= self::find()->where('SUBSTRING(\''.$parser->example_url.'\' ,reg_exp) IS NOT NULL')->all();

            if(count($models)==1 && $models[0]->example_url==$parser->example_url){
                //Нет ошибок
                if($models[0]->status==self::STATUS_HAS_ERROR){
                    $sql="UPDATE parser SET status=".self::STATUS_READY.", err_description='Ошибок не обнаружено.' WHERE id=".$models[0]->id;
                    Yii::$app->db->createCommand($sql)->execute();    

                    //Сбрасываю статус ошибки со всех связанных запрсов
                    $sql="UPDATE request SET status=".Request::STATUS_READY." WHERE status=".Request::STATUS_ERROR." AND request_url ~'".$models[0]->reg_exp."'";
                    Yii::$app->db->createCommand($sql)->execute();    
                }
                $has_error=false;
            }

            if(count($models)>1){
                $msg='';
                foreach ($models as $key => $model) {
                    $msg.=$model->example_url.PHP_EOL;
                }
                $description='Выражение возвращает более одного значения: '.$msg;
            }
            if(count($models)==0){
                $description='Выражение возвращает пустое значение';
            }
            if(count($models)==1 && $models[0]->example_url!=$parser->example_url){
                $description='Выражение возвращает неверный url ('.$models[0]->example_url.')';
            }

            if($has_error){
                $sql="UPDATE parser SET status=".self::STATUS_HAS_ERROR.", err_description='".$description."' WHERE id=".$parser->id;
                Yii::$app->db->createCommand($sql)->execute();    
            }
        }

        

        return false;
        
    }


}
