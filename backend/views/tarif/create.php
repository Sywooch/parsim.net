<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Create tarif');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifs'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarif-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
