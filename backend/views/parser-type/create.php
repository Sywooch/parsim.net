<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Create parser type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parser types'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
