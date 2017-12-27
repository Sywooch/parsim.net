<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "queue_mail".
 *
 * @property integer $id
 * @property string $subject
 * @property string $swift_message
 * @property integer $attempts
 * @property string $last_attempt_time
 * @property string $sent_time
 * @property string $time_to_send
 * @property string $created_at
 */
class QueueMail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'queue_mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['swift_message'], 'string'],
            [['attempts'], 'integer'],
            [['last_attempt_time', 'sent_time', 'time_to_send', 'created_at'], 'safe'],
            [['time_to_send', 'created_at'], 'required'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'swift_message' => Yii::t('app', 'Swift Message'),
            'attempts' => Yii::t('app', 'Attempts'),
            'last_attempt_time' => Yii::t('app', 'Last Attempt Time'),
            'sent_time' => Yii::t('app', 'Sent Time'),
            'time_to_send' => Yii::t('app', 'Time To Send'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['queue-mail/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['queue-mail/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['queue-mail/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['queue-mail/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['queue-mail/view','id'=>$this->id]);
    }
    public function getProcessUrl()
    {
        return Yii::$app->urlManager->createUrl(['queue-mail/process']);
    }
}
