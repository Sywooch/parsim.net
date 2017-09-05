<?php
  $posts=$model->getPosts($limit);
?>
<!-- Post Section
================================================== -->
<?php if(count($posts)>0): ?>
<section class="narrow blog-posts-alt">
  <div class="title-row">
    <h3 class="title-entry"><?= Yii::t('app','Articles'); ?></h3> 
    <a href="<?= $model->blogUrl; ?>" class="btn btn-primary btn-xs">
      <?= Yii::t('app','Find More'); ?> &nbsp; 
      <i class="fa fa-angle-right"></i>
    </a>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <?php foreach ($posts as $key => $post): ?>
      <article class="post">
        <div class="row">
          <div class="col-sm-4">
            <a href="<?= $post->readMoreUrl; ?>" rel="bookmark">
              <div class="entry-thumbnail card"> 
                <?= $post->getImg('sm'); ?>
              </div>
            </a>
          </div>
          <div class="col-sm-8">
            <header class="entry-header"> 
              <a href="<?= $post->readMoreUrl; ?>" rel="bookmark">
                <h2 class="entry-title"><?= $post->title; ?></h2> 
              </a>
              <div class="entry-meta"> 
                <span class="icon-meta"> 
                  <span class="byline"> 
                    <i class="fa fa-user"></i> 
                    <span class="author vcard">
                      <?= $post->authorLink; ?>
                    </span> 
                  </span>
                </span> &nbsp; 
                <span class="icon-meta"> 
                  <span class="posted-on"> 
                    <i class="fa fa-calendar"></i> 
                    <span class="meta-item"><?= $post->createdDate; ?></span> 
                  </span>
                </span>
              </div>
            </header>
            <div class="entry-content">
              <p><?= $post->teaser; ?></p> 
              <a href="<?= $post->readMoreUrl; ?>" class="more-link btn btn-sm btn-primary">
                <?= Yii::t('app','Continue reading'); ?> 
                <span class="meta-nav"> &nbsp; 
                  <i class="fa fa-arrow-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>