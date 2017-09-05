<?php
  use yii\widgets\Menu;
  
  $subMenuItems=[];

  if(count($model->children)>0){
    $subMenuItems[]=['label'=>Yii::t('app','Places'),'url'=>$model->placesUrl];
  }
  $subMenuItems[]=$model->getInfoMenuItems();
  $subMenuItems[]=$model->getDirectionMenuItems();
  if(count($model->posts)>0){
    $subMenuItems[]=['label'=>Yii::t('app','Articles'),'url'=>$model->BlogUrl];  
  }
  

?>
<!-- Sub Navigation
================================================== -->
<div class="sub-nav">
  <div class="navbar navbar-inverse affix-top" id="SubMenu" style="top: 74px;">
    <div class="container">
      <div class="navbar-header">
        <a href="javascript:void(0)" class="navbar-brand scrollTop"><i class="fa fa-fw fa-map-marker"></i> <?= $model->name; ?></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-sub">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <!-- Sub Nav Links -->
      <nav class="navbar-collapse collapse" id="navbar-sub">
        <?=
          Menu::widget([
            'items' => $subMenuItems,
            'options'=>['class'=>'nav navbar-nav navbar-left'],

          ]);
        ?>
        
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><i class="fa fa-fw fa-heart-o"></i></a></li>
          <li class="dropdown show-on-hover">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-share-alt"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#"><i class="fa fa-fw fa-facebook-official"></i> Facebook</a></li>
              <li><a href="#"><i class="fa fa-fw fa-twitter"></i> Twitter</a></li>
              <li><a href="#"><i class="fa fa-fw fa-google-plus"></i> Google +</a></li>
              <li><a href="#"><i class="fa fa-fw fa-pinterest"></i> Pinterest</a></li>
              <li><a href="#"><i class="fa fa-fw fa-instagram"></i> Instagram</a></li>
              <li><a href="#"><i class="fa fa-fw fa-envelope"></i> Email</a></li>
            </ul>
          </li>
          <li><a href="#" data-toggle="tooltip" title="Download in PDF format."><i class="fa fa-fw fa-file-pdf-o"></i></a></li>
          <li><a href="#" data-toggle="tooltip" title="Print and take with you!"><i class="fa fa-fw fa-print"></i></a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>