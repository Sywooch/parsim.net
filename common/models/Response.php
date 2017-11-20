<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use GuzzleHttp\Client; // подключаем Guzzle

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
            if(isset($this->request->response_email))
            {   
                
                Yii::$app->mailqueue->compose(['html' => 'response/responseSuccess'], ['model' => $this,'createUrl'=>Yii::$app->urlManager->createAbsoluteUrl(['/request/create'])])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                    ->setTo($this->request->response_email)
                    ->setSubject('Parsing result from ' . Yii::$app->name)
                    ->queue();
            }

            if(isset($this->response_url))
            {
                $httpClient = new Client();  
                $r = $httpClient->request('POST', $this->response_url, ['data' => $this->json]);
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

    public function regError($status,$msg)
    {
        //Обновляю ответ
        $this->json=null;
        $this->error=json_encode($msg);
        $this->status=$status;
        $this->save();

        //Регистрирую ошибку
        $err_codes=[
            self::STATUS_LOADING_ERROR=>Error::CODE_LOADING_ERROR,
            self::STATUS_PARSING_ERROR=>Error::CODE_PARSING_ERROR,
        ];

        $error=new Error();
        $error->code=$err_codes[$status];
        $error->msg=$msg;
        $error->status=Error::STATUS_NEW;
        $error->request_id=$this->request_id;
        $error->response_id=$this->id;
        $error->parser_id=$this->parser_id;
        $error->loader_id=$this->loader_id;
        $error->save();

        //Обновляю статус запроса
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
    
}
