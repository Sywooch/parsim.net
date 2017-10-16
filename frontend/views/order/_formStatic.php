<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\assets\order\FormStatycAsset;
FormStatycAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\order */
/* @var $form yii\widgets\ActiveForm */
$qty=[
    1=>'1 месяц',
    2=>'2 месяца',
    3=>'3 месяца',
    4=>'4 месяца',
    5=>'5 месяцев',
    6=>'6 месяцев',
    7=>'7 месяцев',
    8=>'8 месяцев',
    9=>'9 месяцев',
    10=>'10 месяцев',
    11=>'11 месяцев',
    12=>'1 год',
]
?>

<!--Content Column-->
<div class="content-column col-md-5 col-sm-12 col-xs-12">
    <div class="order-form">
        <?php $form = ActiveForm::begin([
            'action'=>YII_DEBUG ? 'https://demomoney.yandex.ru/eshop.xml' : 'https://money.yandex.ru/eshop.xml',
            'id'=>'form-pay'
        ]); ?>
        <?php
        echo Html::hiddenInput('shopId', Yii::$app->yakassa->shopId);
        echo Html::hiddenInput('scid', Yii::$app->yakassa->scId);
        echo Html::hiddenInput('sum', number_format($model->amount, 2, '.', ''),['id'=>'sum']);
        echo Html::hiddenInput('customerNumber', $model->user_id,['id'=>'customerNumber']);
        echo Html::hiddenInput('paymentType', 'AC');
        echo Html::hiddenInput('cps_phone', $model->user->phone,['id'=>'cps_phone']);
        echo Html::hiddenInput('cps_email', $model->user->email,['id'=>'cps_email']);
        echo Html::hiddenInput('orderNumber', $model->id,['id'=>'orderNumber']);
        ?>
        <div class="select-input">
            <?= $form->field($model, 'qty')->dropDownList($qty,['id'=>'order-qty'])->label(false) ?>
        </div>
        <h1>Итого к оплате: <span id="total-amount"><?= $model->amount; ?></span> руб.</h1>
        <?= $form->field($model, 'tarif_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'price')->hiddenInput(['id'=>'order-price'])->label(false) ?>
        <?= $form->field($model, 'amount')->hiddenInput(['id'=>'order-amount'])->label(false) ?>
        <div class="form-group">
            <?= Html::button('Оплатить', ['class' => 'btn-block theme-btn btn-style-two','id'=>'btn-submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>
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