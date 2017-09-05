<?php
  use frontend\widgets\HeroSection;
  use frontend\widgets\SubNavigation;
  use frontend\widgets\BannerViewer;
  use frontend\widgets\TopDestinations;
  use frontend\widgets\RateBox;

?>


<?= HeroSection::widget([
    'cssClass'=>'hero small-hero destination-header',
    'title'=>$destination->name,
    'breadcrumbs'=>$destination->breadcrumbItems,
    'imgUrl'=>$destination->imgUrl,
]); ?>

<?= SubNavigation::widget([
    'model'=>$destination
]); ?>


<!-- Main Section
================================================== -->
<section class="main">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-fixed-content">
        <h1 class="page-title"><?= $model->name; ?></h1>
        <ul class="breadcrumbs local-path">
          <li><a href="<?= $model->location->viewUrl; ?>"><?= $model->location->fullName; ?></a></li>
          <li class="no-arrow"><a href="<?= $model->location->getDirectionUrl($model->category->alias); ?>"><?= $model->category->name; ?></a></li>

          <li class="no-arrow">
            <?= RateBox::widget([
              'symbol'=>'star',
              'cssClass'=>'rating rating-star',
              'value'=>$model->rate_quality
            ]);?>
          </li>

          <li class="no-arrow">
            <?= RateBox::widget([
              'symbol'=>'dollar',
              'cssClass'=>'rating rating-price',
              'value'=>$model->rate_price
            ]);?>
          </li>
        </ul>

        <p class="lead"><?= $model->teaser; ?></p>
        <div class="row">
          <div class="col-sm-12 col-lg-8">
            <figure class="entry-thumbnail">
              <p>
                <?= $model->getImg('lg',['class'=>'attachment-post-thumbnail wp-post-image']); ?>
              </p>
            </figure>
            <div class="hidden-lg">
              <?= $this->render('_ouCard',['model'=>$model]); ?>
            </div>
            <div class="entry-content">
              <?= $model->description; ?>
            </div>
          </div>
          <div class="visible-lg-block col-lg-4">
            <?= $this->render('_ouCard',['model'=>$model]); ?>
          </div>
        </div>
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