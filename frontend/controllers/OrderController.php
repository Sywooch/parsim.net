<?php

namespace frontend\controllers;

use Yii;
use common\models\Tarif;
use common\models\Order;
use common\models\Transaction;
use common\models\SignupForm;
use common\models\Error;
use common\models\User;

use common\models\searchForms\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * OrderController implements the CRUD actions for order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'check' => ['POST'],
                    'payment-notification' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','pay','gift'],
                'rules' => [
                    [
                        'actions' => ['create','pay','gift'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ]
        ];
    }

    public function actions()
    {
        return [
            'check' => [
                'class' => 'kroshilin\yakassa\actions\CheckOrderAction',
                
                'beforeResponse' => function ($request) {
                    /**
                     * @var \yii\web\Request $request
                     */
                    $id = (int) $request->post('orderNumber');
                    
                    if(($order = Order::findOne($id)) == null){
                        Yii::warning("Кто-то хотел оплатить несуществующий заказ! Order Id: {$id}", Yii::$app->yakassa->logCategory);    
                        return false;
                    }

                    return false;
                }
            ],
            'payment-aviso' => [
                'class' => 'kroshilin\yakassa\actions\PaymentAvisoAction',
                'beforeResponse' => function ($request) {
                    
                    $id = (int) $request->post('orderNumber');
                    $user_id=(int) $request->post('customerNumber');
                    
                    if(($order = Order::findOne($id)) == null){
                        Yii::warning("Кто-то хотел оплатить несуществующий заказ! Order Id: {$id}", Yii::$app->yakassa->logCategory);    
                        return false;
                    }else{
                        //Создаю транзакцию
                        $transaction=new Transaction();
                        $transaction->type=Transaction::TYPE_IN;
                        $transaction->order_id=$order->id;
                        $transaction->status=Transaction::STATUS_SUCCESS;
                        $transaction->amount=$order->amount;
                        $transaction->created_at=$user_id;
                        $transaction->updated_at=$user_id;
                        if($transaction->save()){
                            $order->status=Order::STATUS_PAID;
                            return $order->save();
                        }else{
                            Yii::warning("Ошибка оплаты заказа! Order Id: {$id}", Yii::$app->yakassa->logCategory);    
                            return false;
                        }
                    }
                    
                }
            ],
        ];
    }
    

    /**
     * Lists all order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionGift($tarif)
    {

        $tarif=Tarif::findOne(['alias'=>$tarif]);
        if(isset($tarif->availableQty) && $tarif->availableQty>0){
            $user=Yii::$app->user->identity;
            $user->tarif_id=$tarif->id;    
            if($user->save()){
                return $this->render('gift',['model'=>$tarif]);    
            }else{
                throw new NotFoundHttpException('Ошибка подключения тарифа.');
            }
        }else{
            return $this->render('unAvailable',['model'=>$tarif]);    
        }
        
        
        
        
    
    }


    public function actionPay($tarif)
    {
        $model = new order();
        $tarif=Tarif::findOne(['alias'=>$tarif]);
        $model->tarif_id=$tarif->id;
        $model->price=$tarif->price;
        $model->user_id=Yii::$app->user->identity->id;

        if($tarif->type==Tarif::TYPE_COST_PER_ACTION){
            $model->amount=1000;
            $model->qty=$model->amount/$tarif->price;
        }

        if($tarif->type==Tarif::STATUS_COST_PER_PERIOD){
            $model->qty=2;
            $model->amount=$tarif->price*$model->qty;
        }
        
        return $this->render('pay', [
            'model' => $model,
        ]);
    }

    public function actionSuccess()
    {
        return $this->render('success');
    }

    public function actionFail()
    {
        return $this->render('fail');
    }

    

    public function actionCreate()
    {
        $model = new order();


        if(Yii::$app->request->isAjax)
        {

            //Обход ограничения  Yandex, он не может обрабатывать значения []
            //в наименовании поля (Order[amount])
            //поэтому этим значениям задаются вручную хначения аттр. nane
            //и вручную обрабатываются в контроллере
            $request = Yii::$app->request;
            $model->amount=$request->post('amount');
            $model->tarif_id=$request->post('tarif_id');
            $model->price=$request->post('price');
            
            
            if ($model->save()) {
                return json_encode($model->toArray());
            }else{
                throw new HttpException(400 ,json_encode($model->toArray()));
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Updates an existing order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax)
        {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return json_encode(['status'=>'Ok']);
            }else{
                throw new NotFoundHttpException(json_encode($model->errors));
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
