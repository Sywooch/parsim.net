<?php
    use yii\helpers\Html;
?>

<div class="row">
  <div class="col-xs-2"><?= Html::activeInput('text',$model,'['.$index.']key',['class'=>"form-control"]); ?></div>
  <div class="col-xs-6"><?= Html::activeInput('text',$model,'['.$index.']selector',['class'=>"form-control"]); ?></div>
  <div class="col-xs-4"><?= Html::activeInput('text',$model,'['.$index.']value',['class'=>"form-control",'placeholder'=>'N/A', 'disabled'=>'disabled']); ?></div>        
</div>