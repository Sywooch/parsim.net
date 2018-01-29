<?php

namespace common\models;

use Yii;

class Request extends \common\models\Request
{

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/create']);
    }
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['request/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['request/view','alias'=>$this->alias]);
    }

    public function getResponsesUrl(){
        return Yii::$app->urlManager->createUrl(['response/index','request_id'=>$this->id]);
    }
    public function getParserUrl(){
        $url='#';
        if(isset($this->parser)){
            $url=$this->parser->updateUrl;
        }
        return $url;
    }
    public function getTransactionsUrl(){
        return Yii::$app->urlManager->createUrl(['transaction/index','request_id'=>$this->id]);
    }
}
