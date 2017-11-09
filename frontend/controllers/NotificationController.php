<?php

namespace frontend\controllers;

use Yii;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\searchForms\NotificationSearch;
use common\models\Notification;

/**
 * OrderController implements the CRUD actions for order model.
 */
class NotificationController extends Controller
{

    public $layout = 'column2';
    
    /**
     * Lists all order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $searchModel->user_id=Yii::$app->user->id;
        $searchModel->status=Notification::STATUS_NEW;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        /*
        $model->status=Notification::STATUS_READED;
        $model->save();
        */
        $model->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
