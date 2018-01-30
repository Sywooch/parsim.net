<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use GuzzleHttp\Client; // подключаем Guzzle
use common\models\parsers\classes\HttpLoader;
use common\models\parsers\classes\BaseParser;

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

    //Возможные сценарии
    const SCENARIO_INSERT=1;
    const SCENARIO_UPDATE=2;

    //Возможные ошибки
    const ERROR_NEED_CHOOSE_TARIF = 1;
    const ERROR_NEED_PAY = 2;


    //=========================================================
    //
    // Блок описание переменных
    //
    //=========================================================

    public $canCreate; //здесь хронится результат для проверок при создания нового запроса. Проверка баланса пользователя и т.п.
    
    public $errorDescription=[
        self::ERROR_NEED_CHOOSE_TARIF=>"Не выбран тариф. Выберите тариф и создайте запрос повторно.",
        self::ERROR_NEED_PAY=>"Для создания запроса недостаточно средств на счете. Необходимо пополнить счет.",   
    ];

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
            ['canCreate'], 'validateOnCreate', 'skipOnEmpty' => false, 'skipOnError' => false, 'on'=>self::SCENARIO_INSERT], //проверка возможности создания запроса в соответствии с бизнес логики. Наличие средств и т.п.
        ];
    }

    public function validateOnCreate($attribute, $params, $validator)
    {
        
        $owner=$this->request->owner;

        if($currentOrder=$owner->currentOrder){
            //Если текущий заказ не оплачен пытаюсь его сразу оплатить
            if(!$currentOrder->isPaid){
                if($owner->balanse>=$currentOrder->amount){
                    $currentOrder->pay();
                }else{
                    $errCode=self::ERROR_NEED_PAY;
                    $this->addError($attribute, $this->errorDescription[$errCode]);
                    return false;
                }
            }

            $tarif=$currentOrder->tarif;
            $balanse=$owner->balanse;
            
            //Если будет превышен лимит по сканнированиям и у пользователя недостаточно средств оплатить превышение
            if($tarif->pars_limit<$currentOrder->resonseCount+1 && $balanse<$tarif->extra_pars_price){
                $errCode=self::ERROR_NEED_PAY;
                $this->addError($attribute, $this->errorDescription[$errCode]);
                return false;
            }


        }else{
            $errCode=self::ERROR_NEED_CHOOSE_TARIF;
            $this->addError($attribute, $this->errorDescription[$errCode]);
            return false;
        }

        
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
    public function getParser(){
        return $this->hasOne(Parser::className(), ['id' => 'parser_id']);
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
            if(isset($this->request->response_email) && $this->request->response_email!='')
            {   
                
                Yii::$app->mailqueue->compose(['html' => 'response/responseSuccess'], ['model' => $this,'createUrl'=>Yii::$app->urlManager->createAbsoluteUrl(['/request/create'])])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->request->response_email)
                    ->setSubject('Parsing result from ' . Yii::$app->name)
                    ->queue();
            }

            //Отправляю данные на указанный URL
            if(isset($this->request->response_url) && $this->request->response_url!='')
            {
                $httpClient = new Client();  
                $r = $httpClient->request(
                    'POST',
                    $this->request->response_url,
                    [
                        'json'=> ['data'=>$this->json]
                    ]
                );
            }

            if(file_exists($this->contentPath)){
                unlink($this->contentPath);    
            }
            
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
        

        return $this->request->responseTo;
    }

    public function getContentPath(){
        return Yii::getAlias($this->request->parser->contentDir.'response_'.$this->alias.'.html');
    }

    private $_targetUrl;
    public function getTargetUrl()
    {
        if(!isset($this->_targetUrl)){
            $this->_targetUrl=$this->request->request_url;
        }

        return $this->_targetUrl;
    }
    public function setTargetUrl($value)
    {
        $this->_targetUrl=$value;
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
        return Yii::$app->urlManager->createUrl(['response/view','id'=>$this->id]);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['response/update','id'=>$this->id]);
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
            $transaction->description='Списание за обработку <a href="/request/view?alias='.$this->request->alias.'">URL</a>. Результат обработки Вы можнеие посмотреть по этой <a href="/response/view?alias='.$this->alias.'">ссылке</a>';
            
            $transaction->save();    
        }
    }
    public function stornoTransaction($description)
    {
        //Если баланс отрицательный (с точки зрения клиента), т.е. списание было,
        //а сторнирования еще нет
        if($this->balanse<0){
            $transaction=new Transaction();
        
            $transaction->type=Transaction::TYPE_IN;
            $transaction->response_id=$this->id;
            $transaction->request_id=$this->request->id;
            $transaction->user_id=$this->request->owner->id;
            $transaction->amount=$this->balanse*(-1); //сторнирую плюсовой суммой
            $transaction->description=$description;
            
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

    public function run()
    {
        
        //$request=$this->request;
        //$content_path=$this->contentPath;

        if($this->loader->type==HttpLoader::TYPE_HTTP){
            
            $parser = BaseParser::initParser($this);
           // $loader=new HttpLoader();

            if($data=$parser->run()){
                $this->regData($data);
                return $this;
            }else{

                //Блокирую последующую обработку ответа
                //и сторнирую оплату (если была)
                $this->rollBack(Response::STATUS_PARSING_ERROR);
                $response->addError('Response',Error::CODE_PARSING_ERROR);
            }
        }

        return false;
        

    }

    public function rollBack($status)
    {
        //Msg ошибку
        $status_msg=[
            self::STATUS_LOADING_ERROR=>'Ошибка загрузки контента',
            self::STATUS_PARSING_ERROR=>'Ошибка разбора контента',
        ];

        //Обновляю ответ
        $this->json=null;
        $this->error=$status_msg[$status];
        $this->status=$status;
        $this->save();

        
        //Обновляю статус родительского запроса
        $this->request->status=Request::STATUS_ERROR;
        $this->request->save();  

        //Сторнирую оплату
        $description='Отмена оплаты по причине обнаруженной ошиби в работе парсера ';
        if($status==self::STATUS_LOADING_ERROR){
            $description.='(ошибка загрузки целевой страницы)';

            //Меняю статус загрузчика
            $loader=$this->loader;
            $loader->status=Loader::STATUS_HAS_ERROR;
            $loader->save();
        }

        if($status==self::STATUS_PARSING_ERROR){
            $description.='(ошибка парсинга целевой страницы)';

            //Меняю статус парсера
            $parser_description='Во время обработки ответа <a href="/response/view?alias='.$this->alias.'">'.$this->alias.'</a> возникла онибка разбора контента';
            $sql="UPDATE parser SET status=".Parser::STATUS_HAS_ERROR.", err_description='".$parser_description."' WHERE id=".$this->parser_id;
            Yii::$app->db->createCommand($sql)->execute(); 
        }
        $this->stornoTransaction($description);
        

    }
    
    private $_balanse;
    public function getBalanse(){
        if(!isset($this->_balanse)){
            $this->_balanse=Yii::$app->db->createCommand('SELECT sum(amount) FROM transaction WHERE response_id='.$this->id)->queryScalar();
        }
        return $this->_balanse;
    }

    public function regError($code,$msg){
        $error=new Error();

        $error->code=$code;
        $error->msg=$msg;
        $error->status=Error::STATUS_NEW;
        $error->request_id=$this->request->id;
        $error->parser_id=$this->parser->id;
        $error->loader_id=$this->loader->id;

        $error->save();

        $this->status=self::STATUS_PARSING_ERROR;
        $this->save();
    }
    
}
