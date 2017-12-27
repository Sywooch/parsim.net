<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Create order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
