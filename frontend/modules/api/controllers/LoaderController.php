<?php
namespace app\modules\api\controllers;

//use yii\rest\ActiveController;
use yii\rest\Controller;
use common\models\Task;

class LoaderController extends Controller
{
    //public $modelClass = 'common\models\Task';

    public function actionIndex()
    {

        
        $task=Task::find()->where(['status'=>Task::STATUS_READY_TO_LOAD,'type'=>Task::TYPE_TASK])->one();
        if(isset($task)){
          $task->status=Task::STATUS_LOADING;
          //$task->save();  
        }else{
          $task=[];
        }
        

        return $task;
    }
}


?>