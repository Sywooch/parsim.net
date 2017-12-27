<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;



$this->title = Yii::t('app', 'E-mail queue');
$this->params['breadcrumbs'][] = $this->title;
$this->params['bodyClass']='has-detached-right';

use backend\assets\testResponse\IndexAsset;
IndexAsset::register($this);

?>
<div class="test-response-index">
  <div class="container-detached">
    <div class="content-detached">
      <div class="task-list">
        <div class="panel panel-flat">
          <div class="panel-body">
            <?= $this->render('_loop',['dataProvired'=>$dataProvider]); ?>
          </div>
        </div>
        <div class="text-center content-group-lg pt-20">
          <?= LinkPager::widget([
            'pagination' => $dataProvider->pagination,
            'options'=>['class'=>'pagination'],
            'prevPageLabel'=>'<i class="icon-arrow-small-left"></i>',
            'nextPageLabel'=>'<i class="icon-arrow-small-right"></i>',
          ]); ?>
        </div>
      </div>    
    </div>
    <div class="sidebar-detached">
      <div class="sidebar sidebar-default">
        <div class="sidebar-content">
          
          <div class="sidebar-category">
            <div class="category-title">
              <span><?= Yii::t('app','Search'); ?></span>
              <ul class="icons-list">
                <li><a href="#" data-action="collapse"></a></li>
              </ul>
            </div>

            <div class="category-content">
              <?= $this->render('_search',['model'=>$model]); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>