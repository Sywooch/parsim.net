<?php
  use yii\helpers\Html;
?>
<div class="tab-pane <?= $key==0?'active':'' ?>" id="action-tab<?= $key; ?>">
  <div class="row">
    <div class="col-md-2">
      <div class="form-group field-parser-name required">
        <?= Html::activeTextInput($model, '['.$key.']name',['class'=>'form-control']); ?>  
        <div class="help-block"></div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group field-parser-name required">
        <?= Html::activeTextInput($model, '['.$key.']selector',['class'=>'form-control']); ?>
        <div class="help-block"></div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group field-parser-name required">
        <?= Html::activeDropDownList($model, '['.$key.']status',$model->statusList,['class'=>'select']); ?>
        <div class="help-block"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group field-parser-name required">
        <?= Html::activeTextInput($model, '['.$key.']example_url',['class'=>'form-control']); ?>
        <div class="help-block"></div>
      </div>
    </div>
  </div>
  <?= Html::activeHiddenInput($model, '['.$key.']id'); ?>
</div>

