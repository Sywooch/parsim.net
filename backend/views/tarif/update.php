<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update tarif').' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifs'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tarif-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
