<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Lookup;
use common\models\Direction;
use backend\widgets\ImageSelector;

/* @var $this yii\web\View */
/* @var $model common\models\Direction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logo-form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'logo-form',
      'options'=>['enctype' => 'multipart/form-data']
  ]); ?>

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
  <div class="panel panel-flat">
    <div class="panel-body">
      <div class="form-group">
        <div class="col-lg-4 pt-5">

          <?= ImageSelector::widget([
              'id'=>'avatar-place',
              'options'=>[
                  'class'=>''
              ],
              'model'=>$model,
              'fileInputAttr'=>'avatarInputFile',
              'fileIdAttr'=>'avatar_id',
              'defaultPrviewImage'=>'/images/blank.png',
              'addBtnTitle'=>'<i class="icon-plus3"></i>',
              'deleteBtnTitle'=>'<i class="icon-trash-alt"></i>',
          ]); ?>
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-md-12">
              <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
              <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
              <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>
            </div>
          </div>

          <?php if($model->isAdmin): ?>
          <div class="row">
            <div class="col-md-6">
              <?= $form->field($model, 'role')->dropDownList($model->roles); ?>
            </div>
            <div class="col-md-6">
              <?= $form->field($model, 'status')->dropDownList(Lookup::items('USER_STATUS')); ?>
            </div>
          </div>
          <?php endif; ?>


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
