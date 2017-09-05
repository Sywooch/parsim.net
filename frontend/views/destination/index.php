<?php
  use frontend\widgets\HeroSection;
  
  $this->title = Yii::t('app', 'Destination').': '. $model->name;
  

?>

<?= HeroSection::widget([
    'cssClass'=>'hero small-hero destination-header',
    'title'=>$model->name,
    'imgUrl'=>$model->imgUrl,
]); ?>


<!-- Main Section
================================================== -->
<section class="main container">
  <div class="places">

    <h3 class="hidden">Places</h3>

    <div class="row">
      <?= $this->render('_loop',['dataProvired'=>$dataProvider]); ?>
    </div>
  </div>
</section>