<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Create mail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'E-mails'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-email-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
