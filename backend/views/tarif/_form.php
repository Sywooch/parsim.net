<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Lookup;


use backend\assets\tarif\FormAsset;
FormAsset::register($this);
?>

<div class="tarif-form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'tarif-form',
  ]); ?>

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6 class="panel-title">Parser settings</h6>
      <div class="heading-elements">
          
      </div>  
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6">
          
          <div class="row">
            <div class="col-md-8">
              <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-2">
              <?= $form->field($model, 'status')->dropDownList($model->statusList,['class'=>'select']); ?>
            </div>
            <div class="col-md-2">
              <?= $form->field($model, 'visible')->dropDownList($model->visibleList,['class'=>'select']); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <?= $form->field($model, 'price')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'time_limit')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'time_unit')->dropDownList($model->timeUnitList,['class'=>'select']); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <?= $form->field($model, 'host_limit')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'pars_limit')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'extra_host_price')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'extra_pars_price')->textInput(['maxlength' => true]); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <?= $form->field($model, 'pars_freq')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'can_export')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'api_access')->textInput(['maxlength' => true]); ?>
            </div>
          </div>

        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <?= $form->field($model, 'description')->textArea(['maxlength' => true,'rows'=>10]); ?>
            </div>
          </div>
          
        </div>
      </div>
    </div>
      
      
    
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
      <div class="heading-elements">
        
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' heading-btn pull-right']) ?>
        <?php
          if(!$model->isNewRecord){
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
