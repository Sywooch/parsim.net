<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\assets\order\FormDynamicAsset;
FormDynamicAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\order */
/* @var $form yii\widgets\ActiveForm */

?>

<!--Content Column-->
<div class="col-xs-12 col-sm-6">
    
    <h2>Сумма</h2>
    <p>
        укажите сумму в рублях, которую хотите внести на счет
    </p>
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
        echo Html::hiddenInput('cps_phone', Yii::$app->user->identity->phone,['id'=>'cps_phone']);
        echo Html::hiddenInput('cps_email', Yii::$app->user->identity->phone,['id'=>'cps_email']);
        echo Html::hiddenInput('orderNumber', $model->id,['id'=>'orderNumber']);
        ?>
        
        <?= $form->field($model, 'amount')->textInput(['placeholder'=>'Сумма оплаты в рублях','name'=>'amount'])->label(false); ?>
        <?= $form->field($model, 'tarif_id')->hiddenInput(['name'=>'tarif_id'])->label(false) ?>
        <?= $form->field($model, 'price')->hiddenInput(['id'=>'order-price','name'=>'price'])->label(false) ?>
        

        <div class="form-group">
            <?= Html::button('Оплатить', ['class' => 'btn-block theme-btn btn-style-two','id'=>'btn-submit']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
