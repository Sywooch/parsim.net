<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Direction */
/* @var $form yii\widgets\ActiveForm */

use backend\assets\project\FormAsset;
FormAsset::register($this);
?>

<div class="project-form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'project-form',
      'options'=>['enctype' => 'multipart/form-data']
  ]); ?>

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
  <div class="panel panel-flat">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6">
          <legend class="text-semibold">
            <i class="icon-store2 position-left"></i>Project info
          </legend>
          <div class="row">
            <div class="col-md-6">
              <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
            </div>

            <div class="col-md-3">
              <?= $form->field($model, 'status')->dropDownList(Lookup::items('PROJECT_STATUS'),['class'=>'select']); ?>
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
