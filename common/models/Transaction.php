<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $order_id
 * @property integer $response_id
 * @property integer $status
 * @property double $amount
 * @property integer $created_at
 * @property integer $updated_at
 */
class Transaction extends \yii\db\ActiveRecord
{
    const TYPE_IN = 0;
    const TYPE_OUT = 1;

    const STATUS_FAIL = 0;
    const STATUS_SUCCESS = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'order_id', 'response_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['order_id'], 'required'],
            [['amount'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'order_id' => Yii::t('app', 'Order ID'),
            'response_id' => Yii::t('app', 'Response ID'),
            'status' => Yii::t('app', 'Status'),
            'amount' => Yii::t('app', 'Amount'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
