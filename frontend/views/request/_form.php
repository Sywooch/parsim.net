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
$tarif=Yii::$app->user->identity->currentTarif;
$freqList=$model->getFreqList($tarif->id);
?>

<div class="request-form form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'request-form',
      'options'=>['enctype' => 'multipart/form-data']
  ]); ?>

    <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
    <?= $form->field($model, 'request_url')->textInput(['maxlength' => true, 'placeholder'=>'Укажите URL, который хотите парсить','class'=>'','disabled' => !$model->isNewRecord]); ?>
    <?= $form->field($model, 'sleep_time')->dropDownList($freqList,['class'=>'select']); ?>
    
    <div class="row">
      <div class="col-md-8">
        <?= $form->field($model, 'response_url')->textInput(['maxlength' => true,'placeholder'=>'Укажите URL, на который нужно отправлять результаты парсинга','class'=>'']); ?>
      </div>
      <div class="col-md-4">
        <?= $form->field($model, 'response_email')->textInput(['maxlength' => true,'placeholder'=>'Укажите E-mail, на который отправлять результаты парсинга','class'=>'']); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), ['class' => ' theme-btn btn-style-one pull-right']) ?>
      </div>
    </div>
   
  <?php ActiveForm::end(); ?>
</div>
