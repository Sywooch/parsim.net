<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\order */

$this->title = 'Оплата';
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
            <!--Content Column-->
            <div class="content-column col-md-5 col-sm-12 col-xs-12">
                <div class="order-form">
                    
                    <?php
                        echo Html::beginForm(YII_DEBUG ? 'https://demomoney.yandex.ru/eshop.xml' : 'https://money.yandex.ru/eshop.xml', 'post');
                        echo Html::hiddenInput('shopId', Yii::$app->yakassa->shopId);
                        echo Html::hiddenInput('scid', Yii::$app->yakassa->scId);
                        echo Html::hiddenInput('sum', $model->amount);
                        echo Html::hiddenInput('customerNumber', $model->user_id);
                        echo Html::hiddenInput('paymentType', 'AC');
                        echo Html::hiddenInput('cps_phone', $model->user->phone);
                        echo Html::hiddenInput('cps_email', $model->user->email);
                        echo Html::hiddenInput('orderNumber', $model->id);
                    ?>
                        <div class="form-group">
                            <?= Html::submitButton('Оплатить', ['class' => 'theme-btn btn-style-one pull-right']) ?>
                            <?= Html::a('< Назад','111', ['class' => 'theme-btn btn-style-two pull-right  mr-10']) ?>
                        </div>
                    <?php
                        echo Html::endForm();
                    ?>
                </div>
            </div>

            <!--Content Column-->
            <div class="content-column col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                <div class="login-content">
                    <h2>Тариф: <?= $model->tarif->price; ?> руб./месяц</h2>
                    <div class="dark-text">
                        Тариф начнет свое действие сразу после оплаты. 
                        Ранее неизрасходованные средства будут списываться в соответствии с новым тарифом.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>