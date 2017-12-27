<?php
namespace backend\controllers;

use Yii;

use yii\web\NotFoundHttpException;
use common\models\Response;
use common\models\searchForms\ResponseSearch;

use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * Site controller
 */
class ResponseController extends BackendController
{
    

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($request_id=null)
    {
        Url::remember();

        $searchModel = new ResponseSearch();
        if(isset($request_id)){
            $searchModel->request_id=$request_id;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();

        if (Yii::$app->request->isAjax){
            return 'ok';
        }
        return $this->redirect(['/request/index']);
        
    }

    public function actionTest($id)
    {
        
        $msg=$this->getMsgData('success','Ok','Ошибок не обнаружено');
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
        
    }

    


    protected function findModel($id)
    {
        if (($model = Response::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The Responseed page does not exist.');
        }
    }

    

}
