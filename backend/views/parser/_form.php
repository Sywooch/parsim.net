<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Lookup;



/* @var $this yii\web\View */
/* @var $model common\models\Direction */
/* @var $form yii\widgets\ActiveForm */

use backend\assets\parser\FormAsset;
FormAsset::register($this);
?>

<div class="parser-form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'parser-form',
  ]); ?>

  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6 class="panel-title">Parser settings</h6>
      <div class="heading-elements">
          <?= $form->field($model, 'status')->dropDownList($model->statusList,['class'=>'multiselect'])->label(false) ?>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          
          <div class="row">
            <div class="col-md-3">
              <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'type_id')->dropDownList($model->typeList,['class'=>'select']); ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'loader_type')->dropDownList($model->loaderList,['class'=>'select']); ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'reg_exp')->textInput(['maxlength' => true]); ?>
            </div>
          </div>
        </div>
      </div>
     
      <?= $this->render('_actions',[
        'form'=>$form,
        'actions'=>$model->actionsArray
      ]); ?>
      
      
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
