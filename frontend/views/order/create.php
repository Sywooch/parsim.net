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

<div class="order-create">
    <?= $this->render($formByType[$model->tarif->type], [
        'model' => $model,
    ]) ?>
</div>

