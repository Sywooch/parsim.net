<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property integer $status
 * @property string $msg
 */
class OrderResponse extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
   

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_response';
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    public function getResponse()
    {
        return $this->hasOne(Response::className(), ['id' => 'response_id']);
    }



    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id','response_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'response_id' => Yii::t('app', 'Response ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function pay()
    {
        //Если цена нулевая (стоимость включена в тариф), то оплата не требуется
        if($this->price==0){
            return true;
        }

        $t= new Transaction();
        $t->type=Transaction::TYPE_OUT;
        $t->status=Transaction::STATUS_SUCCESS;
        $t->user_id=$this->order->user_id;
        $t->order_id=$this->order_id;
        $t->amount=-1*$this->price*$this->qty;
        $t->description='Оплата по тарифу '.$this->order->tarif->name.' за дополнительное сканнирование '.$this->response->alias;
        return $t->save();
    }

    
}
