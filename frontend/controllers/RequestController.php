<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\searchForms\RequestSearch;
use common\models\Request;



/**
 * Site controller
 */
class RequestController extends Controller
{
    public $layout = 'column2';
    
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $searchModel->created_by=Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionCreate()
    {
        $model=new Request();
        $model->sleep_time=1440;

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->viewUrl);
        }

        return $this->render('create',[
            'model'=>$model,
        ]);
    }
    public function actionUpdate($alias)
    {
        $model=$this->findModel($alias);
        

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->viewUrl);
        }

        return $this->render('update',[
            'model'=>$model,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionView($alias)
    {
        $model=$this->findModel($alias);
        return $this->render('view',[
            'model'=>$model,
        ]);
    }


    protected function findModel($alias)
    {
        if (($model = Request::findOne(['alias'=>$alias])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
