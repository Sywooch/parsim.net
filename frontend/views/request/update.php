<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title='Редактирование';
$this->params['title']=$this->title;
  

$this->params['breadcrumbs'][] = ['label' => 'Мои URL', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="request-update">
    <?= 
      $this->render('_form',[
        'model'=>$model,
      ]);
    ?>
</div>