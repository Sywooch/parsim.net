<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "test_response".
 *
 * @property integer $id
 * @property string $data
 */
class TestResponse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_response';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'data' => Yii::t('app', 'Data'),
        ];
    }

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['test-response/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['test-response/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['test-response/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['test-response/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['test-response/view','id'=>$this->id]);
    }
}
