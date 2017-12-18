<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Error;


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


    // Сценарии создания запрос
    const SCENARIO_DEMO='demo';     //запрос создан в демо режиме (оплата не требуется)


    //=========================================================
    //
    // Блок описание переменных
    //
    //=========================================================
    public $reCaptcha; //переменная для хранения значения рекапча
    public $statusDescription=[
        self::STATUS_READY=>'Готов и ожидает следующую обработку',
        self::STATUS_PROCESSING=>'Идет обработка запроса',
        self::STATUS_SUCCESS=>'Обработка завершена успешно',
        self::STATUS_ERROR=>'Обработка завершена с ошибками',
        self::STATUS_NEED_PAY=>'Для возобновления раь=боты требуется пополнеие счета',
        
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
            ['response_email', 'required', 'on' => self::SCENARIO_DEMO],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => Yii::$app->reCaptcha->secret, 'uncheckedMessage' => 'Please confirm that you are not a bot.', 'on' => self::SCENARIO_DEMO],
            [['response_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at','sleep_time','parser_id','action_id'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['request_url', 'response_url'], 'string', 'max' => 512],
            [['statusName'],'safe']
        ];
        
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
    public function getTarif(){
        return $this->hasOne(Tarif::className(), ['id' => 'tarif_id']);
    }

    //Парсер запросов
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

        $parser=Parser::findByUrl($this->request_url);
        if(isset($parser)){
            $this->parser_id=$parser->id;    
        }
        

        //Если запрос создает/изменяет залогиненный пользователь обновляю поля автора/редактора
        //В противном случае эти поля заполняются на уровне контроллера в процессе автоматической регистрации/определения пользователя
        if(isset(Yii::$app->user->id)){
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

        return true;
    }
    


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert && !isset($this->parser_id)){
            //Если во время СОЗДАНИЯ запрса не было заполнено поле parser_id,
            //значит по данному URL не был найден парсер и нужно зарегит на эту тему 
            //ошибку

            $this->regError(Error::CODE_PARSER_NOT_FOUND);
        }
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

        
        if(isset($this->parser)){
            
            $file_name='test_request_'.$this->alias.'.html';
            
            if($this->parser->testUrl($this->request_url,$file_name)){
                $this->status=self::STATUS_READY;      
            }else{
                $this->status=self::STATUS_ERROR;
                $this->addErrors($this->parser->errors);
                //$this->addError('request_url','value');
            }
        }else{
            $this->status=self::STATUS_ERROR;    
            $this->addError('Request->Test()',Error::CODE_PARSER_NOT_FOUND); 
        }

        //$this->save();
        

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
    public static function getFreqList()
    {
        return [
            ''=>'Выполнить один раз',
            //1=>'Раз в минуту',
            15=>'Каждые 15 мин.',
            30=>'Каждые 30 мин.',
            60=>'Каждый час',
            120=>'Каждые 2 часа',
            60*6=>'Четыре раза в сутки',
            60*12=>'Два раза в сутки',
            60*24=>'Раз в сутки',
            60*24*15=>'Раза в 15 дней',
            60*24*30=>'Раза в 30 дней',
        ];
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
    public function getParserUrl(){
        $url='#';
        if(isset($this->parser)){
            $url=$this->parser->updateUrl;
        }
        return $url;
    }
}
