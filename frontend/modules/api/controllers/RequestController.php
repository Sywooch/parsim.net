<?php
namespace app\modules\api\controllers;

use Yii;
use frontend\modules\api\models\RestRequest;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\data\ActiveDataProvider;


class RequestController extends ApiBaseController
{   
    
    public $modelClass = 'frontend\modules\api\models\RestRequest';

    public function actions()
    {
        $actions = parent::actions();

        // отключить действия "delete" и "create"
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        //unset($actions['index']);

        // настроить подготовку провайдера данных с помощью метода "prepareDataProvider()"
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    
    
    public function actionView($requestId){

      
      /* @var $model ActiveRecord */
      $model = $this->findModel($requestId);

      //checkAccess
      if($this->checkAccess('view',$model)){
        $response=$model->response;
        if($response==null){
          return $this->makeError(404,'Запрос еще не обработан');
        }
        return $model->response;
      }else{
        return $this->makeError(403,'Доступ запрещен');
      }

    }
    
    public function actionUpdate($requestId){

      
      /* @var $model ActiveRecord */
      $model = $this->findModel($requestId);

      //checkAccess
      if($this->checkAccess('view',$model)){
      
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model;
      }else{
        return $this->makeError(403,'Доступ запрещен');
      }

    }

    public function actionDelete($requestId){

      
      /* @var $model ActiveRecord */
      $model = $this->findModel($requestId);

      //checkAccess
      if($this->checkAccess('view',$model)){
      
        if ($model->delete() === false) {
          return $this->makeError(520,'Неизвестная ошибка');
        }
        Yii::$app->getResponse()->setStatusCode(204);
      }else{
        return $this->makeError(403,'Доступ запрещен');
      }

    }


    protected function findModel($requestId)
    {
        if (($model = RestRequest::findOne(['alias'=>$requestId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Неверное значение requestId. Запрос с таким requestId не найден.');
        }
    }
    
    public function checkAccess($action, $model = null, $params = [])
    {
        // проверить, имеет ли пользователь доступ к $action и $model
        if ($action === 'view' || $action === 'update' || $action === 'delete') {
          if ($model->created_by == Yii::$app->user->id)
            return true;            
        }
        return false;
    }


    public function prepareDataProvider()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => RestRequest::find()->where(['created_by'=>Yii::$app->user->id]),
            'pagination'=>false
        ]);

        return $dataProvider;
    }
    

    

    
}


?>