<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Request;
use common\models\searchForms\RequestSearch;

use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class RequestController extends Controller
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
                        'actions' => ['index','create','update','delete','view'],
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



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDownload()
    {
        $query = Task::find()->where(['status'=>Task::STATUS_READY_TO_LOAD,'type'=>Task::TYPE_TASK]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

        return $this->render('download', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Logo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($project)
    {
        $model = new Task();
        $model->type=Task::TYPE_TASK;
        $model->status=Task::STATUS_READY_TO_LOAD;
        $project=Project::find()->where(['alias'=>$project])->one();
        $model->parent_id=$project->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project/view', 'alias' => $project->alias]);
        } else {
            return $this->render('create', [
                'project'=>$project,
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Logo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($alias)
    {
        $model = $this->findModel($alias);
        $project=$model->getRoot();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project/view', 'alias' => $project->alias]);
        } else {
            return $this->render('update', [
                'project'=>$project,
                'model' => $model,
            ]);
        }
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Logo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($alias)
    {
        $model=$this->findModel($alias);
        $project_alias=$model->getRoot()->alias;
        $model->delete();

        return $this->redirect(['/project/view', 'alias' => $project_alias]);
        
    }


    protected function findModel($alias)
    {
        //$task= new Task();
        if (($model = Task::find()->where(['alias'=>$alias])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
