<?php

namespace frontend\modules\api\models;

use Yii;
use common\models\Request;


class RestRequest extends Request
{
    

    public function fields()
    {
        return [
            'alias',
            'status',
            'response'
        ];
    }

    public function getResponse(){
        $response= RestResponse::find()->where(['request_id'=>$this->id, 'status'=>RestResponse::STATUS_PARSING_SUCCESS])->orderBy(['created_at'=>SORT_DESC])->one();
        if(isset($response)){
            return $response->json;
        }
        return null;
    } 
}
