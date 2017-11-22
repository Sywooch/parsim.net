<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\searchForms\TicketSearch;
use common\models\Ticket;
use common\models\TicketMessage;




/**
 * Site controller
 */
class TicketController extends Controller
{
    public $layout = 'column2';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','view'],
                'rules' => [
                    [
                        'actions' => ['index','create','update','delete','view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ]
        ];
    }
    
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $searchModel->created_by=Yii::$app->user->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }

    public function actionCreate()
    {
        
        $model=new Ticket();
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
        $message=new TicketMessage();
        $message->ticket_id=$model->id;
        if ($message->load(Yii::$app->request->post()) && $message->save()){
            return $this->redirect($model->viewUrl);
        }
        return $this->render('view',[
            'model'=>$model,
            'message'=>$message,
        ]);
    }


    protected function findModel($alias)
    {
        if (($model = Ticket::findOne(['alias'=>$alias])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
