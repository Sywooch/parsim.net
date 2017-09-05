<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\TaskData;


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
        <div class="col-md-12">
          <legend class="text-semibold">
            <i class="icon-store2 position-left"></i>Task info <span class="label label-primary"><?= $model->statusName; ?></span>
          </legend>
          <div class="row">
            <div class="col-md-6">
              <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <?= $form->field($model, 'url')->textInput(['maxlength' => true]); ?>
        </div>
        <div class="col-md-6">
          <?= $form->field($model, 'aviso_url')->textInput(['maxlength' => true]); ?>
        </div>
      </div>
      
      <h4>Parsing attributes</h4>
      <p class="content-group">Добавте в таблицу атрибуты, которые хотите парсить по заданному URL. <a href="" class="pull-right">Добавить аттрибут</a></p>
      <div class="row">
        <div class="col-xs-2">Key</div>
        <div class="col-xs-6">Selector</div>
        <div class="col-xs-4">Value</div>        
      </div>
      <?php
        $index=-1;
        foreach ($model->dataItems as $index=>$data) {
            echo $this->render('_taskData',['model'=>$data,'index'=>$index]);
        }
        echo $this->render('_taskData',['model'=>new TaskData(),'index'=>$index+1]);
      ?>
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
