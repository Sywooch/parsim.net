<?php

namespace common\models;

use Yii;

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
    public $email;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarif_id','amount'], 'required'],
            [['email'], 'required','when' => function($model) {
                return Yii::$app->user->isGuest;
            }],
            [['email'], 'email'],
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

    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)){
            $this->price=$this->tarif->price;
            $this->user_id=Yii::$app->user->identity->id;
            if($this->tarif->type==Tarif::TYPE_COST_PER_ACTION){
                $this->qty=$this->amount/$this->price;
            }
            if($this->tarif->type==Tarif::STATUS_COST_PER_PERIOD){
                $this->amount=$this->qty*$this->price;
            }
            return true;
        }
        return false;
    }
}
