<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Order;
use common\models\Tarif;

/**
 * Site controller
 */
class TarifController extends Controller
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
                'only' => ['activate'],
                'rules' => [
                    [
                        'actions' => ['activate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ]
        ];
    }
    
    

    public function actionActivate($id)
    {
        
        $user=Yii::$app->user->identity;
        $tarif=Tarif::findOne($id);

        if($user->tarif_id!=$tarif->id){
            $user->tarif_id=$tarif->id;    
            $user->save();

            //Если у пользователя оплачен текущий период, создаю заказ на следующий период
            //Иначе создаю закз на текущий период
            if($user->currentOrderIsPaid){

                //Если создан заказ на следующий период, меняю в нем тарифный план
                //Иначе создаю заказ на следующий период с выбранным тарифным планом
                if(!$nextOrder=$user->nextOrder){
                    $nextOrder=new Order();
                    $nextOrder->begin=strtotime($user->currentOrder->end .' +1 day');
                }
                $nextOrder->changeTarif($tarif);
                $nextOrder->save();

                //Отправляю сообщение о успешно смене тарифа и что новый тариф вступит в силу с даты $order->begin
                //... создаю PoPap сообжение
                
            }else{
                //Если у пользователя есть неоплаченный заказ на текущий период, меняю тариф в существующем заказе
                //Иначе создаю новый заказ с текущей датой начала 
                if(!$currentOrder=$user->currentOrder){
                    $currentOrder=new Order();
                    $currentOrder->begin=strtotime(Date('Y-m-d 00:00:00'));
                }

                $currentOrder->changeTarif($tarif);
                $currentOrder->save();

                //Если у пользователя недостаточно средст для оплаты заказа, редирект на форму пополнения счета
                //Иначе создаю транзакцию оплаты текущего периода
                $userBalanse=$user->balanse;
                $orderAmount=$currentOrder->amount;
                if($balanse<$orderAmount){
                    return $this->redirect(['/transaction/create','amount'=>$orderAmount-$userBalanse]);
                }else{
                    //Создаю новую транзакции превода средст со счета пользователя на счет Parsin.NET
                    //в счет оплаты подписки на текущий период
                    $transaction=new Transaction();
                    $transaction->type=Transaction::TYPE_OUT;
                    $transaction->amount=-1*$orderAmount;
                    $transaction->user_id=$user->id;
                    $transaction->order_id=$currentOrder->id;
                    $transaction->description='Списание средств в счет оплаты периода с '.Yii::$app->formatter->asDate($currentOrder->begin).' по '.Yii::$app->formatter->asDate($currentOrder->end).' по тарифу '.$currentOrder->tarif->name;
                    $transaction->save();
                }

            }
        }
        
        return $this->redirect(['/site/index','#'=>'pricing']);
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
