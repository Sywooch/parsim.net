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
class OrderRequest extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
   

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_parser';
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
            [['order_id','parser_id'], 'required'],
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
            'parser_id' => Yii::t('app', 'Parser ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    
}
