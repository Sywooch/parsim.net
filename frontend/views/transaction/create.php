<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\order */

$this->title = Yii::t('app', 'Оплата');
$this->params['title']=$this->title;

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

