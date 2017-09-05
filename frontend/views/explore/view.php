
<?php  
  use frontend\widgets\HeroSection;

  //$this->params['breadcrumbs']=false;
?>

<?= HeroSection::widget([
    'cssClass'=>'hero small-hero destination-header',
    'title'=>$model->name,
    'subtitle'=>$model->description,
    'imgUrl'=>$model->imgUrl,
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