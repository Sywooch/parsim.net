<?php
  use frontend\widgets\HeroSection;
  use frontend\widgets\SubNavigation;
?>


<?= HeroSection::widget([
    'cssClass'=>'hero small-hero destination-header',
    'title'=>$tag,
    'imgUrl'=>'/images/blank.png',
]); ?>

<!-- Blog Posts
================================================== -->

<section class="main container">

  <h2 class="text-center page-title hidden"><?= Yii::t('app','News Articles & Blogs'); ?></h2>
  <!-- <hr class="small"></hr> -->

  <div class="row blog-posts">
    <div id="content" class="col-lg-12">
      <div class="row">
        <?= $this->render('_loop',['dataProvired'=>$dataProvider]); ?>
      </div>
    </div>
  </div>
</section>