<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Update task').' '.$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['/project/index']];
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['/project/view', 'alias' => $project->alias]];
$this->params['breadcrumbs'][] = $model->title;
?>
<div class="project-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
