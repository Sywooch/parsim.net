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

<div class="ticket-form form">

  
  <?php $form = ActiveForm::begin([
      'id' => 'ticket-form',
      'options'=>['enctype' => 'multipart/form-data']
  ]); ?>

    <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  

    <?= $form->field($model, 'category_id')->dropDownList($model->categoryList,['class'=>'select']); ?>
    <?= $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder'=>'Тема обращения','class'=>'']); ?>
    <?= $form->field($model, 'firstMessage')->textArea(['maxlength' => true, 'placeholder'=>'Текст обращения','class'=>'']); ?>
    
    <div class="row">
      <div class="col-sm-12">
        <?= Html::submitButton('Отправить сообщение', ['class' => ' theme-btn btn-style-one pull-right']) ?>
      </div>
    </div>
   
  <?php ActiveForm::end(); ?>
</div>
