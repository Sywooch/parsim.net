<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Order;


$this->title='Баланс';
$this->params['title']=$this->title;
  
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
  <div class="col-xs-12 transaction-index">
      <?= 
          $this->render('_loopTransaction',[
              'dataProvider'=>$dataProvider,
          ]); 
      ?>
      
  </div>
</div>
<div class="row">
  <div class="col-xs-12 text-right">
    <h2>Остаток: <?= Yii::$app->formatter->asCurrency(Yii::$app->user->identity->balanse); ?></h2>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 text-center">
    <a href="<?= Order::getPayUrl(); ?>" class="theme-btn btn-style-one margin-top-40">Пополнить счет</a>
  </div>
</div>
