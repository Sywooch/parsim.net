<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title='Новое обращение';
$this->params['title']=$this->title;
  

$this->params['breadcrumbs'][] = ['label' => 'Мои обращения', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="ticket-create">
    <?= 
      $this->render('_form',[
        'model'=>$model,
      ]);
    ?>
</div>
