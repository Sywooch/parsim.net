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

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
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
            <div class="col-md-4">
              <?= $form->field($model, 'host')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'class_name')->textInput(['maxlength' => true]); ?>
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'loader_type')->dropDownList($model->loaderList,['class'=>'select']); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <legend class="text-semibold mt-20">
            <i class="icon-pushpin position-left"></i><?= Yii::t('app','Parser actions'); ?>
            <?= Html::a('Add action','#',['class'=>'add-action pull-right text-success']); ?>
          </legend>  

        </div>
      </div>
      <div id="action-list">
      <?php foreach ($model->actions as $key => $action){
        echo $this->render('_action',['model'=>$action,'index'=>$key]);
      }?>
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
