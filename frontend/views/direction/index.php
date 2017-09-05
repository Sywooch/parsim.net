<?php
  use frontend\widgets\HeroSection;
  use frontend\widgets\SubNavigation;

  use yii\widgets\Menu;

  use common\models\Category;
  use frontend\widgets\BannerViewer;
  use frontend\widgets\TopDestinations;

  $menuItems=[];
  $options=[];
  foreach ($model->directions as $direction) {
      
      if(strtolower($direction->alias)==strtolower($categoty)){
        $options=['class'=>'active'];
      }else{
        $options=[];
      }
      
      $menuItems[]=[
        'label'=>ucfirst(Yii::t('app',$direction->name)),
        'url'=>$model->getDirectionUrl($direction->alias),
        'options'=>$options
      ];
  }
  
?>


<?= HeroSection::widget([
    'cssClass'=>'hero small-hero destination-header',
    'title'=>$model->name,
    'breadcrumbs'=>$model->breadcrumbItems,
    'imgUrl'=>$model->imgUrl,
]); ?>

<?= SubNavigation::widget([
    'model'=>$model
]); ?>


<!-- Main Section
================================================== -->
<section class="main">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-fixed-content">
        <div class="row">
          <div class="col-md-3 col-sm-4 page-navigation">
            <?=
              Menu::widget([
                'items' => $menuItems,
                'options'=>['class'=>'nav nav-stacked'],
              ]);
            ?>
            
          </div>

          <div class="col-md-9 col-sm-8">
            <?= $this->render('list',[
              'model'=>Category::findByAlias($categoty),
              'dataProvider'=>$dataProvider,
              'sort'=>$sort
            ]); ?>
          </div>
        </div>
      </div>

      <!-- ///////////////////// -->
      <!-- ////// SIDEBAR ////// -->
      <!-- ///////////////////// -->

      <div class="col-sm-12 col-fixed-sidebar">
        <div class="sidebar-padder">
          <?= BannerViewer::widget([
          ]); ?>

          <?= TopDestinations::widget([
              'limit'=>8
          ]); ?>
        </div>
      </div>
    </div>
  </div>
</section>