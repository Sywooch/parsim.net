<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tarif_id
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;


    //const STATUS_DISABLED = 0;
    //const STATUS_ENABLED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
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
            [['tarif_id','amount'], 'required'],
            [['user_id', 'tarif_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at','qty'], 'integer'],
            [['tarif_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarif::className(), 'targetAttribute' => ['tarif_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['amount'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'tarif_id' => Yii::t('app', 'Tarif ID'),
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

    public function getTarif()
    {
        return $this->hasOne(Tarif::className(), ['id' => 'tarif_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getParsers()
    {
        return $this->hasMany(Parser::className(), ['id' => 'parser_id'])->viaTable('order_parser', ['order_id' => 'id']);
    }

    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    /*
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)){
            return false;
        }

        //some code ..

        return true;
    }
    */

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public function getPayUrl()
    {
        return Yii::$app->urlManager->createUrl(['transaction/create']);
    }

    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['order/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['order/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['order/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['order/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['order/view','id'=>$this->id]);
    }

    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    
    public function getStatusName(){
        return $this->statuses[$this->status]['title'];
    }
    public function getStatusDesctiption(){
        return $this->statuses[$this->status]['description'];
    }
    
    public static function getStatuses(){
        return [
            self::STATUS_ENABLED=>['title'=>'Enabled','description'=>'Включен'],
            self::STATUS_DISABLED=>['title'=>'Disabled','description'=>'Заблокирован'],
        ];
    }
    public static function getStatusList(){
        $list=[];
        foreach (self::getStatuses() as $key => $status) {
            $list[$key]=$status['title'];
        }
        return $list;
    }

    public function changeTarif($tarif)
    {

        $this->tarif_id=$tarif->id;
        $this->qty=1;
        $this->price=$tarif->price;
        $this->amount=$this->qty*$this->price;
        $this->end=strtotime('+'.$this->tarif->time_limit.' '.$this->tarif->time_unit, $this->begin);
    }

    public function getIsPaid()
    {
        if($this->status==self::STATUS_PAID){
            return true;
        }
        return false;
    }

    public function pay()
    {
        
        if($this->user->balanse>=$this->amount){

            $transaction=new Transaction();
            $transaction->type=Transaction::TYPE_OUT;
            $transaction->status=Transaction::STATUS_SUCCESS;
            $transaction->user_id=$this->user_id;
            $transaction->order_id=$this->id;
            $transaction->amount=-1*$this->amount;
            $transaction->description='Оплата услуг с '.Yii::$app->formatter->asDate($this->begin).' по '.Yii::$app->formatter->asDate($this->end).' по тарифу '.$this->tarif->name;

            if($transaction->save()){
                $this->status=self::STATUS_PAID;
                return $this->save();
            }
        }
        return false;
    }

    public function isExtraHost($url)
    {
        if($this->tarif->host_limit>=$this->getHostCount($url)){
            return false;
        }
        return true;
    }
    public function getHostCount($url=null)
    {
        $parserCount=count($this->parsers);

        if(!isset($url)){
            return $parserCount;
        }

        $parserTotalCount=1;

        if($parserCount>0){
            $parserTotalCount=$parserCount+1;
            foreach ($this->parsers as $key => $parser) {
                if($this->getHostName($parser->actions[0]->example_url) == $this->getHostName($url)){
                    $parserTotalCount=$parserCount-1;
                    break;
                }
            }
        }
        return $parserTotalCount;
    }

    private function getHostName($url){
        return parse_url($url,PHP_URL_HOST);
    }


    public function addParser($parser)
    {
        //$parser=Parser::findByUrl($url);

        //Добавляю и оплачиваю парсер, если такого парсера еще нет
        if(OrderParser::findOne(['order_id'=>$this->id,'parser_id'=>$parser->id])==null){
            $order_parser=new OrderParser();

            $order_parser->order_id=$this->id;
            $order_parser->parser_id=$parser->id;
            $order_parser->qty=1;

            if($this->hostCount()+1<=$this->tarif->host_limit){
                $order_parser->price=0; //стоимость была включена в тариф
            }else{
                $order_parser->price=$this->tarif->extra_host_price; //оплата сверх тарифа
            }
            
            if($order_parser->save()){
                $order_parser->pay();
            }    
        }
        
    }


}
