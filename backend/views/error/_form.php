<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Lookup;
use common\models\Parser;



$labelClass=[
  $model::STATUS_NEW=>'label-danger',
  $model::STATUS_IN_PROGRESS=>'label-primary',
  $model::STATUS_TESTING=>'label-primary',
  $model::STATUS_FIXED=>'label-success',
];



?>

<div class="request-form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'request-form',
      'options'=>['enctype' => 'multipart/form-data']
  ]); ?>

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6>Error: <?= $model->code; ?> <span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></h6>
      <h6><?= $model->msg; ?></h6>
      <div class="heading-elements">
          <?= $form->field($model, 'status')->dropDownList($model->statusList,['class'=>'multiselect'])->label(false) ?>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <?= $form->field($model, 'description')->textArea(['rows' => 10]); ?>
        </div>
      </div>
    </div>
    
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
      <div class="heading-elements">
        

        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' heading-btn pull-right']) ?>
        <?php
          if(!$model->isNewRecord){
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'alias' => $model->alias], [
              'class' => 'btn btn-danger pull-right',
              'data' => [
                  'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                  'method' => 'post',
              ],
            ]);
          }
        ?>

      </div>
    </div>
  </div>
  
  <?php ActiveForm::end(); ?>
</div>
