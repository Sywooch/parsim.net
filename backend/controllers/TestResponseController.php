<?php
namespace backend\controllers;

use Yii;
use ZipArchive;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use common\models\TestResponse;
use common\models\searchForms\TestResponseSearch;

class TestResponseController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        
        Url::remember();
        
        $searchModel = new TestResponseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();

        if (Yii::$app->request->isAjax){
            return 'ok';
        }

        return $this->redirect(['index']);
    } 

    

    protected function findModel($id)
    {
        //$task= new Task();
        if (($model = TestResponse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
