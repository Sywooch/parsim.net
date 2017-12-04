<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Lookup;



/* @var $this yii\web\View */
/* @var $model common\models\Direction */
/* @var $form yii\widgets\ActiveForm */

//use backend\assets\request\FormAsset;
//FormAsset::register($this);
?>

<div class="request-form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'request-form',
      'options'=>['enctype' => 'multipart/form-data']
  ]); ?>

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
  <div class="panel panel-flat">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <legend class="text-semibold">
            <i class="icon-download4 position-left"></i>Request status <span class="label label-primary"><?= $model->statusName; ?></span>
          </legend>
          <div class="row">
            <div class="col-md-4">
              <?= $form->field($model, 'request_url')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'sleep_time')->dropDownList($model->freqList,['class'=>'select']); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'status')->dropDownList($model->statusList,['class'=>'select']); ?>
            </div>
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'response_url')->textInput(['maxlength' => true]); ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'response_email')->textInput(['maxlength' => true]); ?>
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
