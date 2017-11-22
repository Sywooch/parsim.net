<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "ticket_message".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $ticket_id
 * @property string $message
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class TicketMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_message';
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
            [['parent_id', 'ticket_id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['ticket_id', 'message'], 'required'],
            [['message'], 'string'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketMessage::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'parent_id' => Yii::t('app', 'Parent ID'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'message' => Yii::t('app', 'Message'),
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
    public function getOwner(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
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

        return true;
    }
}
