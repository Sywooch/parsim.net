<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Order;
use common\models\Tarif;


class OrderController extends Controller
{

    public function actionFillDate(){
        $orders=Order::find()->all();
        $tarif=Tarif::findOne(['alias'=>'bazovyj']);

        foreach ($orders as $key => $order) {
            $order->tarif_id=$tarif->id;
            $order->begin=$order->created_at;
            $order->end=strtotime('+1 '.$tarif->time_unit,$order->created_at);
            $order->save();
        }
        

    }

    
  
}