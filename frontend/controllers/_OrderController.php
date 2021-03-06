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
    public $layout = 'column2';
    
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
                    'payment-aviso' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','pay'],
                'rules' => [
                    [
                        'actions' => ['create','pay'],
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
                    
                    $alias = $request->post('orderNumber');
                    
                    if(($order = Order::find()->where(['alias'=>$alias])->one()) == null){
                        Yii::warning("Кто-то хотел оплатить несуществующий заказ! Order Id: {$alias}", Yii::$app->yakassa->logCategory);    
                        return false;
                    }


                    return true;
                }
            ],
            'payment-aviso' => [
                'class' => 'kroshilin\yakassa\actions\PaymentAvisoAction',
                'beforeResponse' => function ($request) {
                    
                    $alias = $request->post('orderNumber');
                    $user_id=(int) $request->post('customerNumber');
                    
                    if(($order = Order::find()->where(['alias'=>$alias])->one()) == null){
                        Yii::warning("Кто-то хотел оплатить несуществующий заказ! Order Id: {$alias}", Yii::$app->yakassa->logCategory);    
                        return false;
                    }else{
                        //Создаю транзакцию
                        $transaction=Transaction::findOne(['order_id'=>$order->id,'status'=>Transaction::STATUS_SUCCESS]);

                        if($transaction == null){
                            $transaction=new Transaction();
                            $transaction->type=Transaction::TYPE_IN;
                            $transaction->user_id=$user_id;
                            $transaction->order_id=$order->id;
                            $transaction->status=Transaction::STATUS_SUCCESS;
                            $transaction->amount=$order->amount;
                            $transaction->created_at=$user_id;
                            $transaction->updated_at=$user_id;
                            $transaction->description='Пополнение счета';

                            if($transaction->save()){
                                $order->status=Order::STATUS_PAID;
                                return $order->save();
                            }else{
                                Yii::warning("Ошибка оплаты заказа! Order Id: {$alias}", Yii::$app->yakassa->logCategory);    
                                return false;
                            }
                        }else{
                            //Отправка данных для чека???
                            //Yii::warning("Попытка повторно оплатить транзакцию! Transaction Id: {$transaction->id}", Yii::$app->yakassa->logCategory);    
                            return true;
                        }
                        
                    }
                    
                    return true;
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

    public function actionPay()
    {
        $model = new order();
        $tarif=Yii::$app->user->identity->tarif;

        $model->tarif_id=$tarif->id;
        $model->price=$tarif->price;
        $model->user_id=Yii::$app->user->identity->id;

        if($tarif->type==Tarif::TYPE_COST_PER_ACTION){
            $model->amount=1000;
            $model->qty=$model->amount/$tarif->price;
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSuccess()
    {
        $this->layout = 'content';
        return $this->render('paySuccess');
    }

    public function actionFail()
    {
        $this->layout = 'content';
        return $this->render('payFail');
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
            //$model->qty=$request->post('qty');
            
            
            if ($model->save()) {
                return json_encode($model->toArray());
            }else{
                throw new HttpException(400 ,json_encode($model->toArray()));
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
