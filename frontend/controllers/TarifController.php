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
use common\models\Transaction;

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
                    $nextOrder->begin=strtotime('+1 day',$user->currentOrder->end);
                }
                $nextOrder->changeTarif($tarif);
                $nextOrder->save();

                //Отправляю сообщение о успешно смене тарифа и что новый тариф вступит в силу с даты $order->begin
                $message='<p>Тариф успешно изменен!</p>';
                $message.='<p>Новый тариф вступит в силу с '.Yii::$app->formatter->asDate($nextOrder->begin).'</p>';
                Yii::$app->getSession()->setFlash('success', $message);
                
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
                $userBalanse=0;//$user->balanse;
                $orderAmount=$currentOrder->amount;
                if($userBalanse<$orderAmount){
                    return $this->redirect(['/transaction/create','amount'=>$orderAmount-$userBalanse]);
                }else{
                    //Создаю новую транзакции превода средст со счета пользователя на счет Parsin.NET
                    //в счет оплаты подписки на текущий период
                    $currentOrder->pay();
                    
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
