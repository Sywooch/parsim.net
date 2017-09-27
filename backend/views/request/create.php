<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Logo */
//$project=$model->getRoot();

$this->title = Yii::t('app', 'Create task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'projects'), 'url' => ['/project/index']];
$this->params['breadcrumbs'][] = ['label' => $project->title, 'url' => ['/project/view', 'alias' => $project->alias]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
