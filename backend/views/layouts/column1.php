<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo">
  <div class="navbar-header">
    <a class="navbar-brand" href="<?= Yii::$app->urlManager->createUrl('site/index'); ?>"><img src="/images/logo-light.png" alt=""></a>

    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>

  
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Content area -->
      <div class="content">
        <?= $content; ?>
        <?= $this->render('_footer',['class'=>'footer text-muted text-center']); ?>
      </div>
      <!-- /content area -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
</div>
<!-- /page container -->
<?php $this->endContent(); ?>