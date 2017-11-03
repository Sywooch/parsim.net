<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'Responses').' '.$model->alias;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Responses'), 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $model->alias

//use backend\assets\parser\ViewAsset;
//ViewAsset::register($this);

?>


<div class="parser-view">

  
  <div class="panel panel-flat">
    <div class="panel-heading">
      <h6 class="panel-title text-semibold"><?= $model->alias; ?></h6>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-12">
          <label class="text-semibold pr-20">Url:</label><?= $model->request->request_url; ?>
        </div> 
        
        <div class="col-sm-6">
          <label class="text-semibold pr-20">Response to</label><?= $model->responseTo; ?>
        </div> 
        <div class="col-sm-6">
          <label class="text-semibold pr-20">Data:</label><?= $model->json; ?>
        </div> 
        
      </div>
      
    </div>
    
    <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
      <div class="heading-elements">
        
      </div>
    </div>
    
  </div>
</div>


