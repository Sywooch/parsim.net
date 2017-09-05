<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Logo */

$this->title = Yii::t('app', 'Create user');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
