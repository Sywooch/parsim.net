<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update parser').' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parsers'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="parser-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
