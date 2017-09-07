<?php
namespace app\modules\api\controllers;

//use app\modules\api\controllers\ApiController;
use common\models\Task;

class LoaderController extends ApiController
{
    
    public function actionIndex()
    {
        $task=Task::find()->where(['status'=>Task::STATUS_READY_TO_LOAD,'type'=>Task::TYPE_TASK])->one();
        if(isset($task)){
          //$task->status=Task::STATUS_LOADING;
          //$task->save();  
        }else{
          $task=[];
        }
        return $task;
    }
}


?>