<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
class Tarif extends \yii\db\ActiveRecord
{
    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    const TYPE_FREE = 0;
    const TYPE_COST_PER_ACTION = 1;
    const STATUS_COST_PER_PERIOD = 2;
    
    const FREE_TARIF = 1;
    const DEFAULT_TARIF = 2;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
                'src'=>'name',
                'dst'=>'alias',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tarif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'status','qty'], 'integer'],
            [['price'], 'number'],
            [['name','description'], 'string', 'max' => 128],
            [['duration'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'duration' => Yii::t('app', 'Duration'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getOptions(){
        return $this->hasMany(TarifOption::className(), ['tarif_id' => 'id'])->orderBy(['order_num'=>SORT_ASC]);
    }

    
    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================
    public static function findVisible()
    {
        return self::find()->where(['status'=>self::STATUS_ENABLED,'visible'=>1])->all();
    }
    public static function findDefault()
    {
        return self::findOne(self::DEFAULT_TARIF);
    }

    
    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['tarif/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['tarif/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['tarif/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['tarif/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['tarif/view','id'=>$this->id]);
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

    public static function getTimeUnitList(){
        return [
            ''=>'Безлимитный',
            'month'=>'Месяц',
            'year'=>'Год',
        ];
    }
    public function getTimeUnitName(){
        return $this->timeUnitList[$this->time_unit];
    }


    

    public function getVisible()
    {
        return $this->visible==1?true:false;
    }
    public static function getVisibleList(){
        return [
            0=>'Не показывать',
            1=>'Показывать'
        ];
    }

    public function getAvailableQty()
    {
        if(isset($this->qty)){
            $utilization=count(User::find()->where(['tarif_id'=>$this->id])->all());
            return $this->qty-$utilization;
        }
        return null;
    }

    public function getFullName()
    {

        return Yii::$app->formatter->asCurrency($this->price).' / парсинг' ;
    }

    public static function getDefaultPrice()
    {
        $model=self::findDefault();

        return $model->price;
    }
}
