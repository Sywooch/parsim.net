<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

use common\models\Response;
use common\models\searchForms\ResponseSearch;

use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class ResponseController extends Controller
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
                        'actions' => ['index','view'],
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
        $searchModel = new ResponseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    public function actionView($alias)
    {
        $model = $this->findModel($alias);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    protected function findModel($alias)
    {
        if (($model = Response::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The Responseed page does not exist.');
        }
    }
    

}
