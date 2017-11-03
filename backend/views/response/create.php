<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Logo */

$this->title = Yii::t('app', 'Create request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parser-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
