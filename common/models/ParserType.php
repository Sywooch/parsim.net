<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parser_type".
 *
 * @property integer $id
 * @property string $name
 */
class ParserType extends \yii\db\ActiveRecord
{
  
    const STATUS_ENABLED = 0;
    const STATUS_DISABLED = 1;

    public static function tableName()
    {
        return 'parser_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','status'], 'required'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }


    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser-type/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser-type/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser-type/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser-type/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser-type/view','id'=>$this->id]);
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
        return $statusDescription=[
            self::STATUS_ENABLED=>['title'=>'Enabled','description'=>'Включен'],
            self::STATUS_DISABLED=>['title'=>'Disabled','description'=>'Заблокирован'],
        ];
    }
    public static function getStatusList(){
        $list=[];
        foreach (ParserType::getStatuses() as $key => $status) {
            $list[$key]=$status['title'];
        }
        return $list;
    }

}
