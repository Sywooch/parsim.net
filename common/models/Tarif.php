<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarif".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $status
 * @property string $duration
 * @property double $price
 */
class Tarif extends \yii\db\ActiveRecord
{
    const STATUS_BLOCK = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_FREE = 0;
    const TYPE_COST_PER_ACTION = 1;
    const STATUS_COST_PER_PERIOD = 2;
    


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
            [['type', 'status'], 'integer'],
            [['name'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 128],
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
        return self::find()->where(['status'=>self::STATUS_ACTIVE,'visible'=>1])->all();
    }


    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getVisible()
    {
        return $this->visible==1?true:false;
    }

    
    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public function getOrderUrl()
    {
        return Yii::$app->urlManager->createUrl(['order/pay','tarif'=>$this->alias]);
    }
}