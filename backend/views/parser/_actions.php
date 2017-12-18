<?php

  use yii\widgets\Menu;
  use common\models\ParserAction;
  
  $statysClass=[
    ParserAction::STATUS_READY => 'label-success',
    ParserAction::STATUS_HAS_ERROR => 'label-danger',
    ParserAction::STATUS_FIXING => 'label-default',
  ];

  $items=[];
  foreach ($actions as $key => $model) {
    $template = '<a href="{url}" data-toggle="tab">{label}<span class="label '.$statysClass[$model->status].' position-right">'.$model->statusName.'</span></a>';
    $items[]=['label'=>$model->name,'url'=>'#action-tab'.$key,'template'=>$template,'active'=>($key==0?true:false)];
  }


?>
<div class="row">
  <div class="col-md-12">
    <div class="tabbable">
      <?=
        Menu::widget([
          'items' => $items,
          'options'=>['class'=>'nav nav-tabs nav-tabs-highlight display-inline-block'],
        ]);
      ?>

      <div class="pl-20 display-inline-block pull-right">
        <button type="button" class="mb-20 btn border-warning text-warning-600 btn-flat btn-icon "><i class="icon-plus3"></i> Добавить действие</button>  
      </div>

      <div class="tab-content">
        <?php foreach ($actions as $key => $model): ?>
          <div class="tab-pane <?= $key==0?'active':'' ?>" id="action-tab<?= $key; ?>">
            <div class="row">
              <div class="col-md-2">
                <?= $form->field($model, '['.$key.']name')->textInput() ?>
              </div>
              <div class="col-md-8">
                <?= $form->field($model, '['.$key.']selector')->textInput() ?>
              </div>
              <div class="col-md-2">
                <?= $form->field($model, '['.$key.']status')->dropDownList($model->statusList,['class'=>'select']) ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <?= $form->field($model, '['.$key.']example_url')->textInput() ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    
  </div>
  
</div>