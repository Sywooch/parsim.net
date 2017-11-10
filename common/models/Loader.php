<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loader".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $type
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Loader extends \yii\db\ActiveRecord
{
    const TYPE_HTML_CLIENT = 0;
    const TYPE_IMACROS = 1;

    const STATUS_RAEDY = 0;
    const STATUS_HAS_ERROR = 1;
    const STATUS_FIXING = 2;
    

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'loader';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [['type', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 16],
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
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getTypeName(){
        return Lookup::item('LOADER_TYPE',$this->type);
    }
    public function getTypeList(){
        return Lookup::items('LOADER_TYPE');
    }


    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['loader/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['loader/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['loader/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['loader/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['loader/view','id'=>$this->id]);
    }
}
