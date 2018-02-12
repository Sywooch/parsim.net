<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\search\OrderSearch;
use backend\models\search\TransactionSearch;
/**
 * Site controller
 */
class SiteController extends BackendController
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
                        'actions' => ['index'],
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
        $orderSearch= new OrderSearch();
        $transactionSearch= new TransactionSearch();
        if (Yii::$app->request->isAjax){
            
            if ($orderSearch->load(Yii::$app->request->post()) && $orderSearch->validate()){
                return $this->renderPartial('_vLastOrders',[
                    'model'=>$orderSearch,
                ]);
            }

            if ($transactionSearch->load(Yii::$app->request->post()) && $transactionSearch->validate()){
                return $this->renderPartial('_vLastTransactions',[
                    'model'=>$transactionSearch,
                ]);
            }
        }

        $orderSearch->begin=strtotime('first day of this month');
        $orderSearch->end=strtotime(date("Y-m-d 23:59:59"));

        $transactionSearch->begin=strtotime('first day of this month');
        $transactionSearch->end=strtotime(date("Y-m-d 23:59:59"));

        return $this->render('index',[
            'orderSearch'=>$orderSearch,
            'transactionSearch'=>$transactionSearch,
        ]);
    }


    public function actionError()
    {
        $this->layout = 'column1';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();

            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message
            ]);
        }
    }
    
}
