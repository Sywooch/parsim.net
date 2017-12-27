<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'Parser').' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parsers'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->name;

use backend\assets\parser\ViewAsset;
ViewAsset::register($this);

?>


<div class="parser-view">

  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6 class="panel-title text-semibold"><?= $model->name; ?></h6>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <label class="text-semibold pr-20">Parser class:</label><?= $model->className; ?>
        </div> 
        
        <div class="col-sm-6">
          <label class="text-semibold pr-20">Example url:</label><?= $model->exampleUrl; ?>
        </div> 
        <div class="col-sm-6">
          <label class="text-semibold pr-20">Reg exp:</label><?= $model->reg_exp; ?>
        </div> 
        <div class="col-sm-12">
          </label><?= $model->description; ?>
        </div> 
      </div>
    </div>
    
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
      <div class="heading-elements">
        <?php if($model->status==$model::STATUS_HAS_ERROR): ?>
          <span class="heading-text text-danger-400"><i class="icon-bug2  position-left"></i> <?= $model->err_description; ?></span>
        <?php elseif($model->status==$model::STATUS_READY): ?>
          <span class="heading-text text-success-400"><i class="icon-checkmark3  position-left"></i> <?= $model->err_description; ?></span>
        <?php endif; ?>
        
        <?= Html::a('Изменить',$model->updateUrl, ['class' => 'btn btn-success heading-btn pull-right']) ?>
      </div>
    </div>
  </div>
  
  
</div>


