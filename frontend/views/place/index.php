<?php
  use frontend\widgets\HeroSection;
  use frontend\widgets\SubNavigation;
?>


<?= HeroSection::widget([
    'cssClass'=>'hero small-hero destination-header',
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

    <h3 class="hidden">Places</h3>

    <div class="places">
      <div class="row">
        <?= $this->render('_loop',['dataProvired'=>$dataProvider]); ?>
      </div>
    </div>
  </div>
</section>
