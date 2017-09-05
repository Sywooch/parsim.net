<?php
  $places=$model->getPlaces($limit);
?>
<!-- Places Section
================================================== -->
<?php if(count($places)>0): ?>
<section class="narrow places">
  <div class="title-row">
    <h3 class="title-entry"><?= Yii::t('app','Places in').' '.Yii::t('app',$model->name); ?></h3> <a href="<?= $model->placesUrl; ?>" class="btn btn-primary btn-xs"><?= Yii::t('app','Places in'); ?> &nbsp; <i class="fa fa-angle-right"></i></a></div>
  <div class="row">
    <?php foreach ($places as $key => $place): ?>
    <div class="col-sm-6">
      <article class="place-box card">
        <a href="<?= $place->viewUrl; ?>" class="place-link">
          <header>
            <h3 class="entry-title"><i class="fa fa-map-marker"></i><?= $place->fullName; ?></h3> </header>
          <div class="entry-thumbnail"> 
            
            <?= $place->getImg('sm',['ckass'=>'attachment-place wp-post-image']); ?>
          </div>
        </a>
      </article>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>