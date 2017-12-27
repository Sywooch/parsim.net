<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update request').' '.$model->alias;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="request-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
