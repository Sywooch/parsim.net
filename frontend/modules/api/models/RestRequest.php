<?php

namespace frontend\modules\api\models;

use yii\web\ServerErrorHttpException;

use Yii;
use common\models\Request;
use common\models\Lookup;


class RestRequest extends Request
{
    

    public function rules()
    {
        $rules = parent::rules();

        $rules[]=[['frequency','requestUrl','responseUrl','responseEmail'],'safe'];
        return $rules;

    }
    public function fields()
    {
        return [
            'requestId',
            'requestUrl',
            'frequency',
            'responseUrl',
            'responseEmail'
        ];
    }

    public function getResponse(){
        $response= RestResponse::find()->where(['request_id'=>$this->id, 'status'=>RestResponse::STATUS_PARSING_SUCCESS])->orderBy(['created_at'=>SORT_DESC])->one();
        if(isset($response)){
            return json_decode($response->json);
        }
        return null;
    } 

    public function getRequestId(){
        return $this->alias;
    }

    public function getRequestUrl(){
        return $this->request_url;
    }
    public function setRequestUrl($value){
        $this->request_url=$value;
    }

    public function getResponseUrl(){
        return $this->response_url;
    }
    public function setResponseUrl($value){
        $this->response_url=$value;
    }
    public function getResponseEmail(){
        return $this->response_email;
    }
    public function setResponseEmail($value){
        $this->response_email=$value;
    }

    public function getFrequency(){
        return $this->sleep_time;
    }
    public function setFrequency($value){
        $this->sleep_time=$value;
    }
    
}
