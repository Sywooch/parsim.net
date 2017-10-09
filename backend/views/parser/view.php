<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Parser').' '.$model->host;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parsers'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->host;

use backend\assets\parser\ViewAsset;
ViewAsset::register($this);

?>


<div class="parser-view">

  
  <?php $form = ActiveForm::begin([
      'id' => 'parser-view',
  ]); ?>

  <?= $form->errorSummary($model,['class'=>'alert alert-danger alert-bordered']); ?>  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6 class="panel-title">TEST URL: <?= $model->host; ?></h6>
      
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <?= Html::textInput('url',null,['class'=>'form-control','id'=>'test-url']); ?>
        </div> 
        
      </div>
    </div>
    
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
      <div class="heading-elements">
        <span class="heading-text">Test result:<span id="test-result"></span></span>
        <?= Html::a('Изменить',$model->updateUrl, ['class' => 'btn btn-success heading-btn pull-right']) ?>
        <?= Html::button('Test', ['class' => 'btn btn-primary heading-btn pull-right btn-test']) ?>
        
      </div>
    </div>
  </div>
  
  <?php ActiveForm::end(); ?>
</div>


