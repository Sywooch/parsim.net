<?php
  use yii\helpers\Html;

  use common\models\Tag;

  use frontend\widgets\HeroSection;
  use frontend\widgets\TopDestinations;
  use frontend\widgets\TopPosts;
  use frontend\widgets\PostTopics;
  

?>

<?= HeroSection::widget([
    'cssClass'=>'hero small-hero',
    'title'=>(isset($model)?$model->title:Yii::t('app','Blog')),
    'imgUrl'=>(isset($model)?$model->imgUrl:'/images/blank.png'),
]); ?>



<!-- Main Section
================================================== -->

<section class="main container">
  <div id="content" class="row">
    <div class="col-sm-8 col-md-6 col-md-push-3">

      <h3 class="hidden"><?= $model->title; ?></h3>

      <article class="post">
        <div class="entry-summary">
          <?= $model->teaser; ?>
        </div>
        <div class="entry-content">
          <?= $model->content; ?>
        </div>
        
        <div id="comments" class="comments-area">
          <?php if($model->commentCount){
            echo $this->render('_comments',['model'=>$model]);
          }?>

          <?= $this->render('_commentForm',[
            'model'=>$comment
          ]); ?>

        </div>
        
      </article>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3 col-md-pull-6 blog-details-column">
      <div class="entry-meta">
        <span class="icon-meta">
          <span class="posted-on"> <i class="fa fa-calendar"></i>
            <span class="meta-item"><?= $model->createdDate; ?></span>
          </span>
        </span>

        <div class="byline icon-meta">
          <i class="fa fa-user "></i>
          <span class="author vcard meta-item">
            <?= $model->authorLink; ?>
          </span>
        </div>

        <?php if($model->commentCount): ?>
        <div class="comments-link icon-meta">
          <i class="fa fa-comments"></i>
          <span class="meta-item">
            <a href="#comments-list"><?= $model->commentCount; ?> <?= Yii::t('app','Comments'); ?></a>
          </span>
        </div>
        <?php endif; ?>
        <div class="cat-links icon-meta">
          <i class="fa fa-folder"></i>
          <?php foreach ($model->categories as $categor): ?>
            <?= Html::a($categor->name,$model->getCategoryPostsUrl($categor->alias),['rel'=>'category tag']); ?>
          <?php endforeach; ?>
          
        </div>
        <?php if(isset($model->tags)): ?>
        <div class="tag-links icon-meta">
          <i class="fa fa-tag"></i>
          
          <?php foreach (Tag::string2array($model->tags) as $key => $tag) {
            echo Html::a($tag.' ',$model->getTagPostsUrl($tag),['rel'=>'tag','style'=>'margin-right:5px;']);
          }?>
        </div>
        <?php endif;?>
      </div>

      <div class="sidebar">
        <div class="sidebar-padder">
          <div class="widget scg_widget single-post-left widget_text">
            <div class="textwidget">
              <hr>
              <p>Are you a writer? Are you interested in seeing the world, and being paid to do it? Of course you are.
                <br>
                <br> <a href="#"><strong>Find our more</strong> <i class="fa fa-arrow-right"></i></a></p>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="sidebar col-xs-12 col-sm-4 col-md-3">
      <div class="sidebar-padder">
        <?= TopDestinations::widget([
            'limit'=>8
        ]); ?>
        <?= TopPosts::widget([
            'limit'=>8,
            'excludeId'=>$model->id
        ]); ?>

        <?= PostTopics::widget([
        ]); ?>

      </div>
    </div>
  </div>
</section>