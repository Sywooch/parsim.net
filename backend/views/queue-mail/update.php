<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update E-mail').' '.$model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'E-mail queue'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="queue-email-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
