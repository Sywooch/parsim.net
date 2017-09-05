<?php
  use frontend\widgets\HeroSection;
  use frontend\widgets\SubNavigation;
  use frontend\widgets\TopDestinations;
  
  use frontend\widgets\IntroSection;
  use frontend\widgets\InfoSection;
  use frontend\widgets\DirectSection;
  use frontend\widgets\PlaceSection;
  use frontend\widgets\PostSection;
  use frontend\widgets\BannerViewer;
  

  $this->title = Yii::t('app', 'Place').': '. $model->name;
  

?>

<?= HeroSection::widget([
    'title'=>$model->name,
    'imgUrl'=>$model->imgUrl,
    'breadcrumbs'=>$model->breadcrumbItems
]); ?>
<?= SubNavigation::widget([
    'model'=>$model
]); ?>

<!-- Main Section
================================================== -->

<section class="main">
  <div class="container">

    <h3 class="hidden">Place</h3>

    <div class="row">
      <div class="col-sm-12 col-fixed-content">
       
       <?= IntroSection::widget([
            'model'=>$model,
        ]); ?>
        
        <?= PlaceSection::widget([
            'model'=>$model,
        ]); ?>

        <?= InfoSection::widget([
            'model'=>$model,
        ]); ?>

        <?= DirectSection::widget([
            'model'=>$model,
        ]); ?>

        <?= PostSection::widget([
            'model'=>$model,
        ]); ?>

      </div>
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