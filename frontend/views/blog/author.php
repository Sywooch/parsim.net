<?php
  use yii\helpers\Html;
  use frontend\widgets\HeroSection;
?>

<?= HeroSection::widget([
    'cssClass'=>'hero small-hero',
    'title'=>Yii::t('app','Posts by').' '.$model->fullName,
    'imgUrl'=>'/images/hero-1.jpg',
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