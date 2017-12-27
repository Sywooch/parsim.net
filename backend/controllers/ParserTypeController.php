<?php
namespace backend\controllers;

use Yii;
use ZipArchive;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use common\models\ParserType;
use common\models\searchForms\ParserTypeSearch;

class ParserTypeController extends BackendController
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
                        'actions' => ['index','create','update','delete','view','disable','enable'],
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
        
        $searchModel = new ParserTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionCreate()
    {
        $model = new ParserType();

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->goBack();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        return $this->redirect(['index']);
    } 

    public function actionDisable($id)
    {
        $model=$this->findModel($id);
        $model->status=ParserType::STATUS_DISABLED;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }
    public function actionEnable($id)
    {
        $model=$this->findModel($id);
        $model->status=ParserType::STATUS_ENABLED;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }

    protected function findModel($id)
    {
        //$task= new Task();
        if (($model = ParserType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
