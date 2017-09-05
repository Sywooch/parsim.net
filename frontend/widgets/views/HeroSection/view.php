<?php
use yii\widgets\Breadcrumbs;
/*
if($breadcrumbs && isset($model)){
  $breadcrumbs=$model->breadcrumbItems;  
}else{
  $breadcrumbs=[];
}
*/

?>
<!-- Hero Section
================================================== -->
<section class="<?= $cssClass; ?>" style="background-image: url(<?= $imgUrl; ?>);">
  <div class="bg-overlay">
    <div class="container">
      <div class="intro-wrap">
        <?php if($title): ?>
        <h1 class="intro-title"><?= $title; ?></h1>
        <?php endif; ?>
        <?php if($subtitle): ?>
        <div class="intro-text">
          <p><?= $subtitle; ?></p>
        </div>
        <?php endif; ?>

        <?=
          Breadcrumbs::widget([
              'homeLink'=>[
                'label'=>'<i class="icon fa fa-map-marker"></i>',
                'encode'=>false,
                'url'=>'/',
                'template'=>'<li class="no-arrow">{link}</li>'
              ],
              'links' => $breadcrumbs,
              'options'=>['class'=>'breadcrumbs']
          ]);
        ?>
      </div>
    </div>
  </div>
</section>