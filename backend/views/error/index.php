<?php

use yii\helpers\Html;
//use yii\widgets\ListView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchForms\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Errors');
$this->params['breadcrumbs'][] = $this->title;
$this->params['bodyClass']='has-detached-right';

?>
<div class="request-index">
  <p>
    <?= Html::a(Yii::t('app', 'Clear all'), $model->clearUrl, ['class' => 'btn btn-danger']) ?>
    

  </p>
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