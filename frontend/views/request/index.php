<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title='Мои URL';
$this->params['title']=$this->title;
  
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="request-index">
    <?= 
        $this->render('_loop',[
            'dataProvider'=>$dataProvider,
        ]); 
    ?>
</div>
