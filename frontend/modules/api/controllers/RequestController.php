<?php
namespace app\modules\api\controllers;

//use app\modules\api\controllers\ApiController;
use frontend\modules\api\models\RestRequest;


class RequestController extends ApiBaseController
{   
    
    public $modelClass = 'frontend\modules\api\models\RestRequest';

    public function actionView($alias){
        return RestRequest::findOne(['alias'=>$alias]);
    }

    

    
}


?>