<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update order').' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tarif-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
