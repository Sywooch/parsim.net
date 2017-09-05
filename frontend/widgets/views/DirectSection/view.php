<?php
  $directions=$model->getDirections($limit);
?>
<!-- Direct Section
================================================== -->
<?php if(count($directions)>0): ?>
<section class="narrow directory">
  <div class="title-row">
    <h3 class="title-entry"><?= Yii::t('app','Directory'); ?></h3> <a href="<?= $model->directionUrl; ?>" class="btn btn-primary btn-xs"><?= Yii::t('app','Find More'); ?> &nbsp; <i class="fa fa-angle-right"></i></a></div>
  <div class="row">
    <?php foreach ($directions as $key => $direction): ?>
    <div class="col-sm-6 col-lg-4">
      <article class="place-box card">
        <a href="<?= $model->getDirectionUrl($direction->alias)?>" class="place-link">
          <header>
            <h3 class="entry-title"><i class="fa fa-folder"></i><?= $direction->name; ?></h3> </header>
          <div class="entry-thumbnail"> 
            <?= $direction->getImg('md',['class'=>'attachment-place wp-post-image']); ?>
          </div>
        </a>
      </article>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>