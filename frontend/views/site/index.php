<?php
use frontend\widgets\HeroSection;
use common\models\Post;

$this->title = 'My Yii Application';
$this->params['bodyClass']="home";

?>



<?= HeroSection::widget([
    'title'=>Yii::t('app','Where the Journey Begins'),
    'subtitle'=>Yii::t('app','Discover your next great adventure, become an explorer to get started!'),
    'imgUrl'=>$destination->imgUrl,
    'cssClass'=>'hero hero-overlap',
]); ?>


<!-- Featured Destinations
================================================== -->
<section class="featured-destinations">
  <div class="container">
    <div class="cards overlap">

      <!-- Section Title -->
      <div class="title-row">
        <h3 class="title-entry"><?= Yii::t('app','Featured Destinations'); ?></h3>
        <a href="<?= $destination->indexUrl; ?>" class="btn btn-primary btn-xs"><?= Yii::t('app','Find More');?> &nbsp; <i class="fa fa-angle-right"></i></a>
      </div>

      <!-- Cards Row -->
      <div class="row">
        <?php foreach ($places as $key => $place): ?>
          <?php $firstCategory=$place->findPatentByLevel(2); ?>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <article class="card">
              <a href="<?= $place->viewUrl; ?>" class="featured-image" style="background-image: url(<?= $place->getImgUrl('sm'); ?>)">
                <div class="featured-img-inner"></div>
              </a>
              <div class="card-details">
                <h4 class="card-title"><a href="<?= $place->viewUrl; ?>"><?= $place->fullName; ?></a></h4>
                <div class="meta-details clearfix">
                  <ul class="hierarchy">
                    <li class="symbol"><i class="fa fa-map-marker"></i></li>
                    <li><a href="<?= $firstCategory->viewUrl; ?>"><?= $firstCategory->name; ?></a></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
        <?php endforeach;?>
      </div> <!-- /.row -->
    </div>
  </div>
</section>


<!-- Home Page Search Section
================================================== -->
<section class="regular">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-4">
        <figure style="text-align:center">
          <img src="/images/logo-symbol-complex-colors.png" alt="GoExplore!" width="387" height="214">
        </figure>
      </div>
      <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-0">

        <div class="col-md-12 col-lg-10 col-lg-offset-1">
          <h3 style="text-align: center;">Be more than just another traveler when you <em>GoExplore!</em></h3>
        </div>
        <div class="col-sm-12">
          <form class="big-search">
            <input type="text" placeholder="Find Your Next Destination...">
            <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
          </form>
        </div>

      </div>
    </div> <!-- /.row -->
  </div> <!-- /.container -->
</section>


<!-- Home Page Accordion Section
================================================== -->
<section class="regular background">
  <div class="container">
    <div class="row">

      <h3 class="hidden"><?= Yii::t('app','Destination Categories'); ?></h3>

      <?php foreach ($explorers as $index => $explore): ?>
      <div class="col-md-6 col-lg-4">
        <article class="card accordion-card">
          <header>
            <h3 class="section-title"><?= Yii::t('app',$explore->name); ?></h3>
            <p><?= Yii::t('app',$explore->description); ?></p>
          </header>
          <div class="accordion-panel">
            <div class="panel-group" id="accordion-<?= $index; ?>" role="tablist" aria-multiselectable="true">
              <?php foreach ($explore->findPlacesByCategory(3) as $subindex=>$place): ?>
              <!-- Guide Panel -->
              <div class="panel panel-default" style="background-image: url('<?= $place->getImgUrl('sm'); ?>');">
                <div id="collapse-<?= $index;?>-<?= $subindex;?>" class="panel-collapse collapse <?=($subindex==0?'in':''); ?>" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <div class="read-more"><?= Yii::t('app','Details'); ?> <i class="fa fa-arrow-right"></i></div>
                    <a href="<?= $place->viewUrl; ?>"><div class="spacer"></div></a>
                  </div>
                </div>
                <a data-toggle="collapse" data-parent="#accordion-<?= $index; ?>" href="#collapse-<?= $index;?>-<?= $subindex;?>" aria-expanded="true" aria-controls="collapse-<?= $index;?>-<?= $subindex;?>">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <div class="panel-icon">
                      <i class="fa fa-map-marker"></i>
                    </div>
                    <h4 class="panel-title"><?= $place->fullName; ?></h4>
                    <ul class="hierarchy">
                      <li><?= $place->findPatentByLevel(2)->name; ?></li>
                    </ul>
                  </div>
                </a>
              </div>
              <?php endforeach;?>
            </div>
          </div>
          <footer><a href="<?= $explore->viewUrl; ?>"><?= Yii::t('app','Find More'); ?> &nbsp; <i class="fa fa-arrow-right"></i></a></footer>
        </article> <!-- /.accordion-card -->
      </div>
      <?php endforeach;?>
    </div>
  </div>
</section>



<!-- Full Width Carousel
================================================== -->

<section class="featured-slider">

  <h3 class="hidden"><?= Yii::t('app','Highlights'); ?></h3>

  <div class="featured-carousel">
    <?php foreach ($destinations as $dst): ?>
      <div class="item">
        <div class="bg-img" style="background-image: url(<?= $dst->getImgUrl(); ?>)"></div>
        <div class="color-hue"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-6">
              <article>
                <h3><?= $dst->fullName; ?></h3>
                <p class="lead"><?= $dst->description; ?></p>
                <a href="<?= $dst->viewUrl; ?>" class="btn btn-primary"><?= Yii::t('app','Read More'); ?> &nbsp; <i class="fa fa-angle-right"></i></a>
              </article>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>


<!-- Blog Posts
================================================== -->

<section class="regular blog-posts">
  <div class="container">

    <!-- Section Title -->
    <div class="title-row">
      <h3 class="title-entry"><?= Yii::t('app','News Articles & Blogs'); ?></h3>
      <a href="<?= Post::getUrl(); ?>" class="btn btn-primary btn-xs"><?= Yii::t('app','Find More'); ?> &nbsp; <i class="fa fa-angle-right"></i></a>
    </div>

    <div class="row">
      <?php foreach ($posts as $post): ?>
      <div class="col-md-3 col-sm-6">
        <article class="post">
          <div class="card">
            <header class="entry-header">
              <a href="<?= $post->readMoreUrl; ?>">
                <div class="entry-thumbnail" style="background-image: url('<?= $post->getImgUrl('sm'); ?>')">
                  <img alt="" title="" src="/images/blog-placeholder-vertical.png" width="600" height="800">
                </div>
                <h2 class="entry-title"><?= $post->title; ?></h2>
              </a>
            </header>
            <footer class="entry-meta clearfix">
              <span class="byline"><i class="fa fa-user"></i> 
                <span class="author vcard">
                  <?= $post->getAuthorLink(['class'=>'url fn n']); ?>
                </span>
              </span>
              <span class="posted-on">
                <a href="#" rel="bookmark">
                  <time class="entry-date published" datetime="<?= date('Y-m-d H:i:s+00:00',$post->created_at); ?>">
                    <?= $post->createdDate; ?>
                  </time>
                </a>
              </span>
            </footer>
          </div>
          <!-- SAMPLE EXCERPT CONTENT
          ===============================
            <div class="entry-content">
                <p>Fusce egestas elit eget lorem. Viva mus eleme ntum semper nisi. Duis leo. Suspen disse pulvinar, augue ac venen hatis cond imentum, sem libero volut pat nibh, nec pellen tesque velit pede quis nunc. Morbi mattis ullam corper velit. Proin pretium, leo ac pellen tesque mollis, felis nunc ultrices eros, sed gravida augue augue mollis justo.<br>
                <a href="#" class="more-link btn btn-sm btn-primary">Continue reading <span class="meta-nav">→</span></a></p>
              </div>
            -->
        </article>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
