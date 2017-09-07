<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Task;


class LoaderController extends Controller
{

  
    public function actionResetStatus()
    {
        //Сбрасываю статусы по зависшим загрузкам
        $tasks=Task::find()->where(['type'=>Task::TYPE_TASK,'status'=>Task::STATUS_LOADING])->all();
        foreach ($tasks as $key => $task) {
            if($task->changeAge>Yii::$app->params['contentLoadingTime']){
                $old_status=$task->statusName;
                $task->status=Task::STATUS_READY_TO_LOAD;               
                $task->save();
                $new_status=$task->statusName;

                //ToDo регистрирую лог-запись по автору зависания
                //...

                //Если режим разработки собщение в консоль о смене статуса
                if (YII_ENV_DEV){
                    $this->stdout($task->alias.' - change status from "'.$old_status.'" to "'.$new_status.'"'. PHP_EOL);
                }
            }
            
        }
        
    
    }
    
  
}