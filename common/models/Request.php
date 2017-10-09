<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\parsers\BaseParser;


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

            ['response_url', 'required', 'when' => function($model) {
                return !isset($model->response_email);
            }],

            

            [['response_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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


    public function getLoader(){
        return ContentLoader::getTypeByUrl($this->request_url);
    }
    
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

        $host=strtolower(str_replace('www.', '', parse_url($this->request_url, PHP_URL_HOST)));
        $path=parse_url($this->request_url, PHP_URL_PATH);

        $parser=Parser::findOne(['host'=>$host]);

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
            
            $response->action_id=null;
            foreach ($parser->actions as $key => $action){
                if(preg_match($action->reg_exp,$path)){
                    $response->action_id=$action->id;
                }
            }

            if(!isset($response->action_id)){
                $this->regError(Error::CODE_PARSER_ACTION_NOT_FOUND,'Не найдено действие для парсера '.$parser->class_name,$parser->id,null,$loader->id);
                return false;
            }

            if($response->save()){
                $this->status=Request::STATUS_PROCESSING;
                $this->save();
            }

        }else{

            //Регистрирую ошибку 
            $this->regError(Error::CODE_PARSER_NOT_FOUND,'Не найден парсер для хоста '.$host);

            //Создаю черновик парсера
            $parser=new Parser();
            $parser->host=$host;
            $parser->loader_type=Loader::TYPE_HTML_CLIENT;
            $parser->class_name=BaseParser::url2ClassName($this->request_url);
            $parser->status=Parser::STATUS_FIXING;
            $parser->save();

            return false;
        }
    }

    private function regError($code,$msg,$parser_id=null,$action_id=null,$loader_id=null){
        $error=new Error();

        $error->code=$code;
        $error->msg=$msg;
        $error->status=Error::STATUS_NEW;
        $error->request_id=$this->id;
        

        $error->parser_id=$parser_id;
        $error->action_id=$action_id;

        $error->loader_id=$loader_id;

        $error->save();
    }



    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['request/update','alias'=>$this->alias]);
    }


}
