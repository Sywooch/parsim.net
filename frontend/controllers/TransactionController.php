<?php

namespace frontend\controllers;

use Yii;

use common\models\Transaction;
use common\models\Order;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * OrderController implements the CRUD actions for order model.
 */
class TransactionController extends Controller
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
                    $user_id=(int) $request->post('customerNumber');
                    
                    $model= $this->findTransaction($alias,$user_id);
                    if($model){
                        return true;
                    }
                    return false;

                }
            ],
            'payment-aviso' => [
                'class' => 'kroshilin\yakassa\actions\PaymentAvisoAction',
                'beforeResponse' => function ($request) {
                    
                    $alias = $request->post('orderNumber');
                    $user_id=(int) $request->post('customerNumber');
                    $invoice_id=$request->post('invoiceId');
                    
                    if($transaction=$this->findTransaction($alias,$user_id)){
                        $transaction->status=Transaction::STATUS_SUCCESS;
                        $transaction->invoice_id=$invoice_id;
                        if($transaction->save()){

                            //Если требуется, оплачиваю текущий период
                            //$currentOrder=$transaction->owner->currentOrder;
                            //$currentOrder->status=123;
                            //$currentOrder->save();
                            $currentOrder=Order::findOne(10);

                            if($currentOrder && !$currentOrder->isPaid){
                                $currentOrder->pay();
                            }

                            return true;
                        }
                    }

                    return false;
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
    
    //Создание транзакции пополнения счета пользователя
    public function actionCreate($amount=1000)
    {
        $model = new Transaction();
        
        $model->type=Transaction::TYPE_IN;
        $model->status=Transaction::STATUS_NEW;
        $model->user_id=Yii::$app->user->id;
        $model->description='Пополнение счета пользователя';

        $model->amount=$amount;



        if(Yii::$app->request->isAjax)
        {
            //Обход ограничения  Yandex, он не может обрабатывать значения []
            //в наименовании поля (Order[amount])
            //поэтому этим значениям задаются вручную хначения аттр. nane
            //и вручную обрабатываются в контроллере
            $request = Yii::$app->request;
            $model->amount=$request->post('amount');   
            
            if ($model->save()) {
                return json_encode($model->toArray());
            }else{
                throw new HttpException(400 ,json_encode($model->toArray()));
            }
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


    protected function findTransaction($alias,$user_id)
    {
        $model = Transaction::find()->where(['alias'=>$alias,'type'=>Transaction::TYPE_IN,'status'=>Transaction::STATUS_NEW,'user_id'=>$user_id])->one();
        //$model = Transaction::find()->where(['alias'=>$alias])->one();
        if($model){
            return $model;
        } else {
            Yii::warning("Кто-то хотел оплатить несуществующий заказ! Order Id: {$alias}", Yii::$app->yakassa->logCategory);    
            return false;
        }
    }


    
}
