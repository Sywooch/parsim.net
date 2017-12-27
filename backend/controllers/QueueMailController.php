<?php
namespace backend\controllers;

use Yii;
use ZipArchive;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use common\models\QueueMail;
use common\models\searchForms\QueueMailSearch;

class QueueMailController extends BackendController
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
                        'actions' => ['index','process','update','delete'],
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
        
        $searchModel = new QueueMailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionProcess()
    {
        Yii::$app->mailqueue->process();
        return $this->redirect(['index']);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->goBack();    
        }

        return $this->render('update', [
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

        return $this->redirect(['index']);
    } 

    

    protected function findModel($id)
    {
        //$task= new Task();
        if (($model = QueueMail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
