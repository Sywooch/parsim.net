<div class="clearfix">
  <h2 class="pull-left page-title travel-dir-category-title"><?= Yii::t('app',$model->name); ?></h2>
  <?= $this->render('_search',['sort_key'=>$sort]); ?>
</div>

<section class="guide-list">

  <h3 class="hidden"><?= Yii::t('app','Directory Category'); ?></h3>

  <?php
    foreach ($dataProvider->getModels() as $orgunit){
      echo $this->render('_view',['model'=>$orgunit]);
    }
  ?>
  
</section>