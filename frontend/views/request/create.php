<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title='Новый URL';
$this->params['title']=$this->title;
  

$this->params['breadcrumbs'][] = ['label' => 'Мои URL', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="request-create">
    <?= 
      $this->render('_form',[
        'model'=>$model,
      ]);
    ?>
</div>
