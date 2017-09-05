<?php
  $infoPosts=$model->getInfoPosts($limit);
?>
<!-- Info Section
================================================== -->
<?php if(count($infoPosts)>0): ?>
<section class="narrow page-info">
  <div class="title-row">
    <h3 class="title-entry"><?= Yii::t('app','Information'); ?></h3> <a href="<?= $model->infoUrl; ?>" class="btn btn-primary btn-xs"><?= Yii::t('app','Find More'); ?>&nbsp; <i class="fa fa-angle-right"></i></a></div>
  <div class="row">
    <?php foreach ($infoPosts as $key => $infoPost): ?>
    <div class="<?= ($key==0?'col-sm-12 col-lg-8':'col-sm-6 col-lg-4'); ?>">
      <a href="<?= $infoPost->readMoreUrl; ?>" class="page-box-link">
        <article class="page-box">
          <h3 class="entry-title"><?= Yii::t('app',$infoPost->category->name); ?></h3>
          <p class="entry-excerpt">
            <?= $infoPost->teaser; ?>
          </p>
          <p class="more-link"><?= $infoPost->readMoreLink; ?></p>
          <div class="page-box-destination"> <span><i class="fa fa-map-marker"></i> <?= $model->name; ?></span></div>
        </article>
      </a>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>