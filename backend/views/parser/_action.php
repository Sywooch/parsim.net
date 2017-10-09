<?php
use yii\helpers\Html;
?>


<div class="row mb-20 action-item">
  <div class="col-sm-2">
    <?= Html::activeDropDownList($model, '['.$index.']category_id',$model->categoryList,['class'=>'select form-control']); ?>
  </div>
  <div class="col-sm-6">

    <?= Html::activeTextInput($model, '['.$index.']reg_exp',['class'=>'form-control']); ?>
  </div>
  <div class="col-sm-2">
    <?= Html::activeDropDownList($model, '['.$index.']status',$model->statusList,['class'=>'select display-inline-block']); ?>
  </div>
  <div class="col-sm-2 pt-15">
    <?= Html::a('<i class="icon-cross2"></i>','#',['class'=>'remove-item text-danger']); ?>
  </div>
</div>