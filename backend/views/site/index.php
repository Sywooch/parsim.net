<?php

use yii\helpers\Html;

use backend\models\Dashboard;

use backend\assets\site\IndexAsset;
IndexAsset::register($this);



/* @var $this yii\web\View */
/* @var $searchModel common\models\searchForms\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dashboard');


?>
<div class="site-index">
  <!-- Dashboard content -->
  <div class="row">
    <div class="col-lg-8">

      <!-- Parsers list -->
      <?= $this->render('_vParsers'); ?>
      <!-- /Parsers list -->

      <!-- Quick stats boxes -->
      <?= $this->render('_vQuickStats'); ?>
      <!-- /quick stats boxes -->

      <!-- Support tickets -->
      <?= $this->render('_vTickets'); ?>
      <!-- /support tickets -->

    </div>

    <div class="col-lg-4">
      
      <!-- Last orders -->
      <div id="panel-orders">
        <?= $this->render('_vLastOrders',[
          'model'=>$orderSearch,
        ]); ?>  
      </div>
      
      <!-- /last orders -->

      <!-- Last pays-->
      <div id="panel-transactions">
        <?= $this->render('_vLastTransactions',[
          'model'=>$transactionSearch,
        ]); ?>    
      </div>      
      <!-- /Last pays-->

    </div>
  </div>
  <!-- /dashboard content -->
</div>