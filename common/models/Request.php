<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Error;
use yii\httpclient\Client;


class Request extends \yii\db\ActiveRecord
{
    //Таблица в БД
    public static function tableName()
    {
        return 'request';
    }

    //=========================================================
    //
    // Блок описание констант
    //
    //=========================================================
    
    // Возможные статусы
    const STATUS_READY = 0;         //готов к работе, ожидает следующую обработку
    const STATUS_PROCESSING = 1;    //в процессе обработки,идет загрузка контента или парсинг
    const STATUS_SUCCESS = 2;       //обработка завершена успешно
    const STATUS_ERROR = 3;         //обработка завершена с ошибками
    const STATUS_NEED_PAY = 4;      //ожидает оплаты 
    const STATUS_FIXING = 5;      //ожидает оплаты 


    //Возможные сценарии
    const SCENARIO_INSERT=1;
    const SCENARIO_UPDATE=2;

    //Возможные ошибки
    const ERROR_NEED_PAY = 1;

    


    

    //=========================================================
    //
    // Блок описание переменных
    //
    //=========================================================
    public $reCaptcha; //переменная для хранения значения рекапча

    public $canCreate; //здесь хронится результат для проверок при создания нового запроса. Проверка баланса пользователя и т.п.
    public $errorsOnCreate;
    
    public $statusDescription=[
        self::STATUS_READY=>'Готов и ожидает следующую обработку',
        self::STATUS_PROCESSING=>'Идет обработка запроса',
        self::STATUS_SUCCESS=>'Обработка завершена успешно',
        self::STATUS_ERROR=>'Обработка завершена с ошибками',
        self::STATUS_NEED_PAY=>'Для возобновления раь=боты требуется пополнеие счета',
        self::STATUS_FIXING=>'Устраняются ошибки',
        
    ];

    public $errorDescription=[
        self::ERROR_NEED_PAY=>"Для создания запроса недостаточно средств на счете. Необходимо <a href=\"Transaction::getCreateUrl()\">пополнить счет</a>.",   
    ];
    
    
    //=========================================================
    //
    // Блок описание поведений
    //
    //=========================================================
    public function behaviors()
    {
        return [
            //автоматическое заполнение полей даты создания и обновления (created_at и updated_at)
            TimestampBehavior::className(), 
            //автоматическое заполнение поля alias. Поле источник(src) не указан, поэтому заполняется значением uniqid()
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
                //'src'=>'title',
                'dst'=>'alias',
            ],
            //Поведение регистрации ошибки в БД
            /*
            'RegError'=>[
                'class' => 'common\behaviors\RegErrorBehavior',
                'fields'=>[
                    'request_id'=>'id'
                ],
                'setStatus'=>[
                    'field'=>'status',
                    'value'=>self::STATUS_ERROR,
                ]
            ]
            */
        ];
    }

    /**
     * @ Правила валидации
     */
    public function rules()
    {

        return [
            [['request_url'], 'required'],
            [['request_url','response_url'],'url', 'defaultScheme' => ''],
            [['response_email'], 'email'],
            [['response_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at','sleep_time','parser_id','action_id'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['request_url', 'response_url'], 'string', 'max' => 512],
            [['statusName'],'safe'],
            [['canCreate'], 'validateOnCreate', 'skipOnEmpty' => false, 'skipOnError' => false, 'on'=>self::SCENARIO_INSERT], //проверка возможности создания запроса в соответствии с бизнес логики. Наличие средств и т.п.
        ];
        
    }

    public function validateOnCreate($attribute, $params, $validator)
    {
        $this->$attribute=false;

        $errCode=self::ERROR_NEED_PAY;
        //$params['errorCodes'][]=$errCode;
        $this->addError($attribute, $this->errorDescription[$errCode]);

        /*
        if($currentOrder=Yii::$app->user->identity->currentOrder){
            if($model->reg($currentOrder)){
                return $this->redirect($model->getUrl('frontend','view'));    
            }else{
                $err_key=$model->errorKey;
                if($err_key){
                    Yii::$app->getSession()->setFlash('error', $model->errorMsg);

                    if($err_key==Request::ERROR_NEED_PAY){
                        return $this->redirect(Transaction::getCreateUrl());
                    }

                }

                
            }
        }else{
            //Ошибка услуга не подключена
            //Если тариф выбран, переход на форму оплаты

            //Если тариф не установлен, переход на форму выбора тарифа
        }
        */
        
    }

    /**
     * @Описание и перевод полей
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'response_id' => Yii::t('app', 'Response ID'),
            'request_url' => Yii::t('app', 'Target Url'),
            'sleep_time'=>Yii::t('app', 'Parsing frequency'),
            'response_url' => Yii::t('app', 'URL - resonse handler'),
            'response_email' => Yii::t('app', 'E-mail - resonse handler'),
            'responseTo' => Yii::t('app', 'Response to'),
            
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

    //Связанные ответы
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['request_id' => 'id']);
    }
    
    //Количество ответов
    public function getResponseCount()
    {
        return count($this->responses);
    }

    //Автор запроса
    public function getOwner(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    //Тариф запроса
    //public function getTarif(){
    //    return $this->hasOne(Tarif::className(), ['id' => 'tarif_id']);
    //}

    //Парсер запросов
    public function getParser(){
        return $this->hasOne(Parser::className(), ['id' => 'parser_id']);
    }

    //Связанные ответы
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['request_id' => 'id']);
    }
    
    //Количество ответов
    public function getTransactionsCount()
    {
        return count($this->transactions);
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
        if($insert){
            $this->created_by=Yii::$app->user->id;
        }
        $this->updated_by=Yii::$app->user->id;
        

        /*
        if(!isset($this->parser_id)){
            $parser=Parser::findByUrl($this->request_url);
            if(isset($parser)){
                $this->parser_id=$parser->id;    
            }    
        }
        
        

        //Если запрос создает/изменяет залогиненный пользователь обновляю поля автора/редактора
        //В противном случае эти поля заполняются на уровне контроллера в процессе автоматической регистрации/определения пользователя
        
        if(isset(Yii::$app->user) && isset(Yii::$app->user->id)){
            if($insert){
                $this->created_by=Yii::$app->user->id;
            }
            $this->updated_by=Yii::$app->user->id;
        }
        
        
        //Если это демо режим sleep_time=null, это означает выполнить один раз
        if($this->scenario==self::SCENARIO_DEMO){
            $this->sleep_time=null;
            $this->tarif_id=Tarif::FREE_TARIF;
        }
        */
        

        return true;
    }
    


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        /*
        if($insert && !isset($this->parser_id)){
            //Если во время СОЗДАНИЯ запрса не было заполнено поле parser_id,
            //значит по данному URL не был найден парсер и нужно зарегит на эту тему 
            //ошибку

            $this->regError(Error::CODE_PARSER_NOT_FOUND);
        }
        */

    }


    //=========================================================
    //
    // Блок методов класс
    //
    //=========================================================

    //Формирование ответа
    public function addResponse()
    {

        if(isset($this->parser_id)){
            //Если парсер определен

            //Ищу свободный закрузчих 
            //ToDo фильтр по статусу, загруженности и т.п.
            $loader=Loader::findOne(['type'=>$this->parser->loader_type]);
            if(isset($loader)){
                
                //если это бесплатнвый запрос 
                if($this->tarif_id==Tarif::FREE_TARIF){

                    $response= new Response();
                    $response->request_id=$this->id;
                    $response->status=Response::STATUS_READY;

                    $response->loader_id=$loader->id;
                    $response->parser_id=$this->parser->id;


                    if($response->save()){

                        //Обновляю статус запроса
                        $this->status=Request::STATUS_PROCESSING;
                        $this->save();
                        return $response;
                    }else{
                        $this->regError(Error::CODE_REQUEST_CANNOT_CREATE_RESPONSE);
                        return false;
                    }
                }

                //если это платный запрос 
                if($this->owner->hasMoney){
                    $response= new Response();
                    $response->request_id=$this->id;
                    $response->status=Response::STATUS_READY;

                    $response->loader_id=$loader->id;
                    $response->parser_id=$this->parser->id;

                    if($response->save()){
                        
                        //Создаю транзакцию
                        $response->addTransaction();

                        //Обновляю статус запроса
                        $this->status=Request::STATUS_PROCESSING;
                        $this->save();

                        return $response;
                    }else{
                        $this->regError(Error::CODE_REQUEST_CANNOT_CREATE_RESPONSE);
                        return false;
                    }

                }else{
                    //Создаю сообщение о недостатке средств
                    //Для этого выясняю последнию дату оплаты
                    //И дату последнего сообщения о дефиците средств
                    //Сообщение создаю только в том слуяае если дата оплаты больше даты последнего сообщения
                    //т.е. после последней оплаты уведомлений еще не было
                    
                    //Исключаю дубли сообщений                    
                    $need_msg=false;
                    $last_notification=Notification::find()->where(['type'=>Notification::TYPE_NEED_PAY,'user_id'=>$this->owner->id])->orderBy(['created_at'=>SORT_DESC])->one();
                    if(!isset($last_notification)){
                        $need_msg=true;
                    }else{
                        $last_transaction=Transaction::find()->where(['type'=>Transaction::TYPE_IN,'user_id'=>$this->owner->id])->orderBy(['created_at'=>SORT_DESC])->one();
                        if(isset($last_transaction) && $last_notification->created_at<$last_transaction->created_at){
                            $need_msg=true;
                        }
                    }
                    
                    //$need_msg=false;
                    //Добавляю сообщение
                    if($need_msg){
                        $notification=new Notification();
                        $notification->user_id=$this->owner->id;
                        $notification->type=Notification::TYPE_NEED_PAY;
                        $notification->status=Notification::STATUS_NEW;
                        $notification->msg='Работа парсера временно приостановленна, по причине отсутствия средств на счете. Для восстановления работы <a href="/order/pay">пополните</a> свой лицевой счет';
                        $notification->save();

                        //Отправляю E-mail уведомление
                        Yii::$app->mailqueue->compose(['html' => 'user/needPay'], [
                            'payUrl'=>Yii::$app->urlManager->createAbsoluteUrl(['/order/pay'])
                        ])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo($this->owner->email)
                        ->setSubject('Требуется пополнение счета Parsin.NET')
                        ->queue();      
                    }
                }

            }else{
                $this->regError(Error::CODE_LOADER_NOT_FOUND);
                return false;
            }

        }else{
            //Если парсер неизвестен
            return false;
        }
    }


    //Тестирование запроса
    public function test()
    {
        if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$this->request_url)){
            
            if(isset($this->parser)){
                
                $file_name='test_request_'.$this->alias.'.html';
                $data=$this->parser->testUrl($this->request_url,$file_name);
                if($data){
                    return $data;
                }else{
                    $this->addErrors($this->parser->errors);
                }
            }else{
                $this->addError('Request',Error::CODE_PARSER_NOT_FOUND); 
            }
            
        }else{
            $this->addError($action->name,Error::CODE_UNSET_URL);
        }

        return false;

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


    public function sendToTestEmail($email)
    {
        $data=$this->test();

        if($data){
            $response=new Response();
            $response->targetUrl=$this->request_url;
            $response->json=$data;

            Yii::$app->mailqueue->compose(['html' => 'response/responseSuccess'], ['model' => $response,'createUrl'=>Yii::$app->urlManager->createAbsoluteUrl(['/request/create'])])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($email)
            ->setSubject('Parsing result from ' . Yii::$app->name)
            ->send(); 
        }

        if($this->hasErrors()){
            return false;
        }
        return true;
    }

    public function sendToTestUrl($url)
    {
        $data=$this->test();

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
        }

        if($this->hasErrors()){
            return false;
        }
        return true;

    }

    public function run()
    {
        $response=$this->addResponse();
        if($response){
            if($response->run()){
                return $response;
            }else{
                $this->addErrors($response->errors);
            }
        }
        return false;
    }

    public function getAmountIn()
    {
        
        $sum=Yii::$app->db->createCommand('SELECT sum(amount) FROM transaction WHERE type='.Transaction::TYPE_OUT.' AND request_id='.$this->id)->queryScalar();
        if(!isset($sum)){
            $sum=0;
        }
        return -1*$sum;

    }

    public function getAmountOut()
    {
        
        $sum=Yii::$app->db->createCommand('SELECT sum(amount) FROM transaction WHERE type='.Transaction::TYPE_IN.' AND request_id='.$this->id)->queryScalar();
        if(!isset($sum)){
            $sum=0;
        }
        return -1*$sum;

    }


    public function reg($order)
    {
        if($this->canAddRequest($order)){

        }

        return false;
    }

    public function canAddRequest($order)
    {
        //Прверяю лимит запросов, 
        //если лимит не исчерпан добавляю запрос
        //Если лимит исчерпан проверяю наличие средств на счет
        //Если средств достаточно, создаю запрос и транзакцию
        //Если средств не достаточно создаю ошибку о недостатке средств
        $tarif=$order->tarif;
        $user=$order->user;
        if($order->isExtraHost($order->request_url)){
            if($user->balanse<$tarif->extra_host_price){
                $this->addError('custom_error',self::ERROR_NEED_PAY);        
                return false;
            }
        }
        return true;
    }

    public function getErrorMsg()
    {
        $err_key=$this->errorKey;
        if($err_key){
            return $this->errorDescription[$err_key];
        }
        return null;
    }
    public function getErrorKey()
    {
        return $this->getFirstError('custom_error');
    }

    


    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getTarifName()
    {
        if(isset($this->tarif)){
            return $this->tarif->name;
        }
        return '';
    }

    public function getTarifType()
    {
        if(isset($this->tarif)){
            return $this->tarif->type;
        }
        return 0;
    }

    public function getStatusName()
    {
        return Lookup::item('REQUEST_STATUS',$this->status);
    }
    public function getStatusList()
    {
        return Lookup::items('REQUEST_STATUS');
    }

    public function getParserName()
    {
        if(isset($this->parser)){
            return $this->parser->name;
        }
        return 'N/A';
    }

    public function getActionName()
    {
        if(isset($this->action)){
            return $this->action->name;
        }
        return 'N/A';
    }
    

    
    public function getFreqName()
    {
        if(!array_key_exists ($this->sleep_time , $this->freqList )){
            return 'N/A';
        }
        return $this->freqList[$this->sleep_time];
    }
    public static function getFreqList($tarif_id)
    {
        $freq=[
            3=>[
                ''=>'Выполнить один раз',
                24*60=>'Один раз в сутки',
            ],
            4=>[
                ''=>'Выполнить один раз',
                24*60=>'1 раз в сутки',
                24*60/2=>'2 раз в сутки',
                24*60/3=>'3 раз в сутки',
                24*60/4=>'4 раз в сутки',
                24*60/5=>'5 раз в сутки',
                24*60/6=>'6 раз в сутки',
                24*60/7=>'7 раз в сутки',
                24*60/8=>'8 раз в сутки',
                24*60/9=>'9 раз в сутки',
                24*60/10=>'10 раз в сутки',
                24*60/11=>'11 раз в сутки',
                24*60/12=>'12 раз в сутки',
            ],
            6=>[
                ''=>'Выполнить один раз',
                24*60=>'1 раз в сутки (каждые 24 часа)',
                24*60/2=>'2 раз в сутки (каждые 12 часов)',
                24*60/3=>'3 раз в сутки (каждые 8 часов)',
                24*60/4=>'4 раз в сутки (каждые 6 часов)',
                24*60/5=>'5 раз в сутки (каждые 5 часов)',
                24*60/6=>'6 раз в сутки (каждые 4 часа)',
                24*60/7=>'7 раз в сутки (каждые 3.5 часа)',
                24*60/8=>'8 раз в сутки (каждые 3 часов)',
                24*60/9=>'9 раз в сутки',
                24*60/10=>'10 раз в сутки',
                24*60/11=>'11 раз в сутки',
                24*60/12=>'12 раз в сутки',
                24*60/13=>'13 раз в сутки',
                24*60/14=>'14 раз в сутки',
                24*60/15=>'15 раз в сутки',
                24*60/16=>'16 раз в сутки',
                24*60/17=>'17 раз в сутки',
                24*60/18=>'18 раз в сутки',
                24*60/19=>'19 раз в сутки',
                24*60/20=>'20 раз в сутки',
                24*60/21=>'21 раз в сутки',
                24*60/22=>'22 раз в сутки',
                24*60/23=>'23 раз в сутки',
                24*60/24=>'24 раз в сутки',
                24*60/25=>'25 раз в сутки',
                24*60/26=>'26 раз в сутки',
                24*60/27=>'27 раз в сутки',
                24*60/28=>'28 раз в сутки',
                24*60/29=>'29 раз в сутки',
                24*60/30=>'30 раз в сутки',
                24*60/31=>'31 раз в сутки',
                24*60/32=>'32 раз в сутки',
                24*60/33=>'33 раз в сутки',
                24*60/34=>'34 раз в сутки',
                24*60/35=>'35 раз в сутки',
                24*60/36=>'36 раз в сутки',
                24*60/37=>'37 раз в сутки',
                24*60/38=>'38 раз в сутки',
                24*60/39=>'39 раз в сутки',
                24*60/40=>'40 раз в сутки',
                24*60/41=>'41 раз в сутки',
                24*60/42=>'42 раз в сутки',
                24*60/43=>'43 раз в сутки',
                24*60/44=>'44 раз в сутки',
                24*60/45=>'45 раз в сутки',
                24*60/46=>'46 раз в сутки',
                24*60/47=>'47 раз в сутки',
                24*60/48=>'48 раз в сутки',
                24*60/49=>'49 раз в сутки',
                24*60/50=>'50 раз в сутки',
                24*60/51=>'51 раз в сутки',
                24*60/52=>'52 раз в сутки',
                24*60/53=>'53 раз в сутки',
                24*60/54=>'54 раз в сутки',
                24*60/55=>'55 раз в сутки',
                24*60/56=>'56 раз в сутки',
                24*60/57=>'57 раз в сутки',
                24*60/58=>'58 раз в сутки',
                24*60/59=>'59 раз в сутки',
                24*60/60=>'60 раз в сутки',
                24*60/61=>'61 раз в сутки',
                24*60/62=>'62 раз в сутки',
                24*60/63=>'63 раз в сутки',
                24*60/64=>'64 раз в сутки',
                24*60/65=>'65 раз в сутки',
                24*60/66=>'66 раз в сутки',
                24*60/67=>'67 раз в сутки',
                24*60/68=>'68 раз в сутки',
                24*60/69=>'69 раз в сутки',
                24*60/70=>'70 раз в сутки',
                24*60/71=>'71 раз в сутки',
                24*60/72=>'72 раз в сутки',
                24*60/73=>'73 раз в сутки',
                24*60/74=>'74 раз в сутки',
                24*60/75=>'75 раз в сутки',
                24*60/76=>'76 раз в сутки',
                24*60/77=>'77 раз в сутки',
                24*60/78=>'78 раз в сутки',
                24*60/79=>'79 раз в сутки',
                24*60/80=>'80 раз в сутки',
                24*60/81=>'81 раз в сутки',
                24*60/82=>'82 раз в сутки',
                24*60/83=>'83 раз в сутки',
                24*60/84=>'84 раз в сутки',
                24*60/85=>'85 раз в сутки',
                24*60/86=>'86 раз в сутки',
                24*60/87=>'87 раз в сутки',
                24*60/88=>'88 раз в сутки',
                24*60/89=>'89 раз в сутки',
                24*60/90=>'90 раз в сутки',
                24*60/91=>'91 раз в сутки',
                24*60/92=>'92 раз в сутки',
                24*60/93=>'93 раз в сутки',
                24*60/94=>'94 раз в сутки',
                24*60/95=>'95 раз в сутки',
                24*60/96=>'96 раз в сутки',
            ],
            
            
        ];

        return $freq[$tarif_id];
    }

    public function getStatusInfo()
    {
        $info=$this->statusDescription[$this->status];
        

        if($this->status==self::STATUS_ERROR){
            foreach ($this->errors as $key => $errors) {
                foreach ($errors as $errorCode){
                    $error = new Error();
                    $error->code=$errorCode;
                    $info.=' '.$key.' - '.$error->msg;
                }
            }
        }

        return $info;
    }
    
    public function getParserClassName()
    {
        if(isset($this->parser)){
            return $this->parser->className;
        }
        
        return '';
    }

    public function getResponseTo()
    {
        $retval='';
        if(isset($this->response_url) && $this->response_url!=''){
            $retval.=$this->response_url.'; ';
        }
        if(isset($this->response_email) && $this->response_email!=''){
            $retval.=$this->response_email.'; ';
        }
        
        return $retval;
    }

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================

    public function getUrl($app='frontend',$action='index')
    {
        $data=[
            'frontend'=>[
                'index'=>Yii::$app->urlManager->createUrl(['request/index']),
                'create'=>Yii::$app->urlManager->createUrl(['request/create']),
                'update'=>Yii::$app->urlManager->createUrl(['request/update','alias'=>$this->alias]),
                'view'=>Yii::$app->urlManager->createUrl(['request/view','alias'=>$this->alias]),
                'delete'=>Yii::$app->urlManager->createUrl(['request/delete','alias'=>$this->alias]),
            ],
            'backend'=>[
                'index'=>Yii::$app->urlManager->createUrl(['request/index']),
                'create'=>Yii::$app->urlManager->createUrl(['request/create']),
                'update'=>Yii::$app->urlManager->createUrl(['request/update','id'=>$this->id]),
                'view'=>Yii::$app->urlManager->createUrl(['request/view','id'=>$this->id]),
                'delete'=>Yii::$app->urlManager->createUrl(['request/delete','id'=>$this->id]),
            ],
        ];

        return $data[$app][$action];

    }
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/create']);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['request/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/view','id'=>$this->id]);
    }

    public function getResponsesUrl(){
        return Yii::$app->urlManager->createUrl(['response/index','request_id'=>$this->id]);
    }
    public function getParserUrl(){
        $url='#';
        if(isset($this->parser)){
            $url=$this->parser->updateUrl;
        }
        return $url;
    }
    public function getTransactionsUrl(){
        return Yii::$app->urlManager->createUrl(['transaction/index','request_id'=>$this->id]);
    }
}
