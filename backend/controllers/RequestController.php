<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\NotFoundHttpException;

use common\models\Response;

use common\models\Request;
use common\models\searchForms\RequestSearch;

use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * Site controller
 */
class RequestController extends BackendController
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
                    //[
                    //    'actions' => ['error'],
                    //    'allow' => true,
                    //],
                    [
                        'actions' => ['index','create','update','delete','view','response-delete','test','disable','enable','test-email','test-url','run-request'],
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
    public function actionIndex($user_id=null)
    {
        Url::remember();
        
        $searchModel = new RequestSearch();
        if(isset($user_id)){
            $searchModel->created_by=$user_id;
        }
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
        $model->status=Request::STATUS_READY;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect($model->viewUrl);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Logo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($model->indexUrl);
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
    

    public function actionDisable($id)
    {
        $model=$this->findModel($id);
        $model->status=Request::STATUS_FIXING;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }
    public function actionEnable($id)
    {
        $model=$this->findModel($id);
        $model->status=Request::STATUS_SUCCESS;
        $model->save();
        
        return $this->renderPartial('_status', [
            'model' => $model,
        ]);
        
    }

    public function actionTest($id)
    {
        $model=$this->findModel($id);
        $model->test();

        $msg=$this->getMsgData('success','Ok','Ошибок не обнаружено');    
        if($model->hasErrors()){
            $msg=$this->getMsgData('error','Обнаружены ошибки',$model->getErrorSummary() );    
        }
        
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }

    public function actionTestEmail($id)
    {
        $model=$this->findModel($id);

        if($model->status==Request::STATUS_READY || $model->status==Request::STATUS_SUCCESS){
            $email=Yii::$app->params['adminEmail'];
            if($model->sendToTestEmail($email)){
                $msg=$this->getMsgData('info','Сообщение успешно отправлено','получатель: '.$email);            
            }else{
                $msg=$this->getMsgData('error','Ошибка отправки тестового сообщения',$model->getErrorSummary() );           
            }
            
        }else{
            $msg=$this->getMsgData('warning','Сообщение не отправлено','Сообщение возможно отправить только для запросов в статусе READY или SUCCESS');        
        }
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }

    public function actionTestUrl($id)
    {
        $model=$this->findModel($id);

        if($model->status==Request::STATUS_READY || $model->status==Request::STATUS_SUCCESS){
            $url=Yii::$app->params['testUrl'];
            if($model->sendToTestUrl($url)){
                $msg=$this->getMsgData('info','Данные успешно отправлено','URL: '.$url);            
            }else{
                $msg=$this->getMsgData('error','Ошибка отправки данных',$model->getErrorSummary() );           
            }
            
        }else{
            $msg=$this->getMsgData('warning','Данные не отправлено','Можно отправлять только для запросов в статусе READY или SUCCESS');        
        }
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }

    public function actionRunRequest($id)
    {
        $model=$this->findModel($id);

        //$msg=[];
        if($model->status==Request::STATUS_READY || $model->status==Request::STATUS_SUCCESS){
            
            if($respons=$model->Run()){
                $msg=$this->getMsgData('success','Запрос успено выполнен','ID ответа: '.$respons->alias);    
            }else{
                $msg=$this->getMsgData('error','Ошибка обработки запроса /Request->run()/ ',$model->getErrorSummary() );
            }
        }else{
            $msg=$this->getMsgData('warning','Отказ в обработке','Обработать можно только запросы в статусе READY или SUCCESS');        
        }
        //$msg['html']=$this->render->partial('_view',['model'=>$model]);
        
        return json_encode($msg,JSON_UNESCAPED_UNICODE);
    }

    /**
     * Deletes an existing Logo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->delete();

        if (Yii::$app->request->isAjax){
            return 'ok';
        }
        return $this->redirect(['/request/index']);
        
    }

    public function actionResponseDelete($alias)
    {
        $model=Response::findOne(['alias'=>$alias]);

        $request=$model->request;

        $model->delete();

        return $this->redirect(['/request/view','alias'=>$request->id]);
        
    }


    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
