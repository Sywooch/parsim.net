<?php
  use yii\helpers\ArrayHelper;
  use yii\widgets\Menu;

  

  use frontend\assets\AppAsset;
  AppAsset::register($this);


  $menuItems=[]
  
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div id="top"></div>

<div class="wrap">
    <!-- Navigation (main menu)
    ================================================== -->
    <div class="navbar-wrapper">
      <header class="navbar navbar-default navbar-fixed-top" id="MainMenu">
        <div class="navbar-extra-top clearfix">
          <div class="navbar container-fluid">
            <ul class="nav navbar-nav navbar-left">
              <li class="menu-item"><a href="/contact"><i class="fa fa-envelope"></i> <?= Yii::t('app','Contact Us'); ?></a></li>
              <li class="menu-item"><a href="/about"><i class="fa fa-suitcase"></i> <?= Yii::t('app','Join the Explorers!'); ?></a></li>
              <li class="menu-item"><a href="/login"><i class="fa fa-sign-in"></i> <?= Yii::t('app','Sign in'); ?></a></li>
            </ul>
            <div class="navbar-top-right">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-facebook fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter fa-fw"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram fa-fw"></i></a></li>
              </ul>
              <form class="navbar-form navbar-right navbar-search" role="search" action="search.html">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
              </form>
            </div>
          </div>
        </div>

        <div class="container-fluid collapse-md" id="navbar-main-container">
          <div class="navbar-header">
            <a href="/" class="navbar-brand"><img alt="GoExplore!" src="/images/logo.png"><span class="sr-only">&nbsp; GoExplore!</span></a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <nav class="navbar-collapse collapse" id="navbar-main">
            <?=
              Menu::widget([
                'items' => $menuItems,
                'options'=>['class'=>'nav navbar-nav navbar-right'],

              ]);
            ?>
            
          </nav>
        </div><!-- /.container-fluid -->
      </header>
    </div><!-- /.navbar-wrapper -->
    <section class="main" style="margin-top: 60px;">
      <div class="container">
        <?= $content ?>
      </div>
    </section>
    
</div>

<!-- Footer
================================================== -->
<footer id="footer">
  <section class="top-footer regular">
    <div class="container">
      <div class="row">

        <h3 class="hidden"><?= Yii::t('app','More Resources'); ?></h3>

        <div class="col-lg-9">
          <div class="footer-content-left">

            <p style="font-size:14px; color:#aaa;">
              <a href="/about"><?= Yii::t('app','About Us'); ?></a> &nbsp; | &nbsp;
              <a href="/login"><?= Yii::t('app','Sign in'); ?></a> &nbsp; | &nbsp;
              <a href="/travel-category"><?= Yii::t('app','Be an Explorer!'); ?></a> &nbsp; | &nbsp;
              <a href="/destination"><?= Yii::t('app','Destinations'); ?></a> &nbsp; | &nbsp;
              <a href="/blog"><?= Yii::t('app','Blog'); ?></a> &nbsp; | &nbsp;
              <a href="/contact"><?= Yii::t('app','Contact us'); ?></a>
            </p>

            <p style="font-size:14px; color: #999; margin-bottom:0;">
              <strong>An HTML travel template for destinations, guides, blogs, hotels, resorts, tours, vacations, events, and more for a perfect travel experience!</strong>

              <br>Created by <a href="http://para.llel.us" target="_blank">Parallelus</a> and available for purchase on <a href="http://para.llel.us/+/get-goexplore-html" target="_blank">ThemeForest</a>.
            </p>

          </div>
        </div>

        <div class="col-lg-3">
          <div class="footer-content-right">
            <div style="text-align: right;" class="visible-lg-block">
              <img src="/images/logo-symbol-complex-colors.png" alt="GoExplore!" width="1024" height="565" style="max-width: 175px;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="sub-footer">
    <div class="container">
      <div class="row">

        <h3 class="hidden"><?= Yii::t('app','About'); ?></h3>

        <div class="col-xs-12">
          <?php //echo LngSelector::widget();?>

          <span style="color:#999; font-size: 13px;">&copy; <?= date('Y') ?> Created by <a href="http://ptimofeev.com">Pavel Timofeev</a>. <a href="/terms">Terms of Use</a> and <a href="/policy">Privacy Policy</a>.</span>
        </div>
      </div>
    </div>
  </section>
</footer>
<?php $this->endContent(); ?>
