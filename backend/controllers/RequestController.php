<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

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
    /**
     * Creates a new Logo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->viewUrl);
        } else {
            return $this->render('create', [
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->indexUrl);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($alias)
    {
        $model = $this->findModel($alias);
        
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
        if (($model = Request::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
