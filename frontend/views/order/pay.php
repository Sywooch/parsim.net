<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\order */

$formByType=[
  0=>'_formFree',
  1=>'_formDynamyc',
  2=>'_formStatic'
];

$this->title = Yii::t('app', 'Оплата');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Title -->
            <div class="title-column col-md-6 col-sm-8 col-xs-12">
                <h1>Оплата</h1>
            </div>
            <!--Bread Crumb -->
            <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li class="active">Оплата</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->

<section class="order-section alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            <?= $this->render($formByType[$model->tarif->type], [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</section>

