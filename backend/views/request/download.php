<?php

use yii\helpers\Html;
use yii\grid\ListView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchForms\LogoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
//$this->params['bodyClass']='has-detached-right';

//$dataProvider=$model->search();

?>
<div class="project-index">
  
  <div class="row">
    <div class="col-xs-12">
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
  </div>
</div>