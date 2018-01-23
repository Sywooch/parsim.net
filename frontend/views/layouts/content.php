<?php
  use yii\helpers\ArrayHelper;
  use yii\widgets\Menu;

  use common\models\User;
  use common\models\Notification;

  use frontend\assets\AppAsset;
  AppAsset::register($this);


  $menuItems=[];

  use yii\widgets\Breadcrumbs;
  if(!array_key_exists('title',$this->params)){
    $this->params['title']=null;
  }
  if(!array_key_exists('breadcrumbs',$this->params)){
    $this->params['breadcrumbs']=[];
  }
  
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="page-wrapper">
  
  <!-- Preloader -->
  <div class="preloader"></div>

  

  <ul id="noty_topRight_layout_container" class="i-am-new" style="top: 20px; right: 20px; position: fixed; width: 310px; height: auto; margin: 0px; padding: 0px; list-style-type: none; z-index: 10000000;">
    <?php if(Yii::$app->getSession()->hasFlash('error')): ?>
    <li style="overflow: hidden; border-radius: 3px; margin-bottom: 1px; box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px; background-color: rgb(239, 83, 80); color: rgb(255, 255, 255); width: 310px; cursor: pointer;">
      <div class="noty_bar noty_type_error" id="noty_57405028414799810">
        <div class="noty_message" style="font-size: 13px; line-height: 1.53846; text-align: left; padding: 15px 20px; width: auto; position: relative;">
          <span class="noty_text"><?= Yii::$app->getSession()->getFlash('error'); ?></span>
        </div>
      </div>
    </li>
    <?php endif; ?>
    <?php if(Yii::$app->getSession()->hasFlash('success')): ?>
    <li style="overflow: hidden; border-radius: 3px; margin-bottom: 1px; box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px; background-color: rgb(76, 175, 80); color: rgb(255, 255, 255); width: 310px; cursor: pointer;">
      <div class="noty_bar noty_type_success" id="noty_1479585960865614800">
        <div class="noty_message" style="font-size: 13px; line-height: 1.53846; text-align: left; padding: 15px 20px; width: auto; position: relative;">
          <span class="noty_text"><?= Yii::$app->getSession()->getFlash('success'); ?></span>
        </div>
      </div>
    </li>
    <?php endif; ?>
  </ul>

  <!-- Main Header-->
  <header class="<?= (isset($this->params['headerClass'])?$this->params['headerClass']:'main-header header-style-three'); ?>">
      
      <?php if(!Yii::$app->user->isGuest): ?>
      <div class="header-top">
        <div class="auto-container">
            <div class="clearfix">
                  
                  <!--Top Left-->
                  <div class="top-left">
                    <ul class="link-nav clearfix">
                        <li><a href="#"><span class="icon fa fa-phone"></span>(880) 172 380 956</a></li>
                          <li><a href="#"><span class="icon fa fa-envelope"></span>seoboostinc@gmail.com</a></li>
                      </ul>
                  </div>
                  
                  <!--Top Right-->
                  <div class="top-right">
                    <ul class="social-icon-one">
                        <li>Stay Connected</li>
                          <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                          <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                          <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                          <li><a href="#"><span class="fa fa-pinterest-p"></span></a></li>
                      </ul>
                      <a href="#" class="login-btn"><span class="icon fa fa-lock"></span>Login</a>
                  </div>
                  
              </div>
              
          </div>
      </div>
      <?php endif; ?>
      <!-- Main Box -->
      <div class="main-box">
        <div class="auto-container">
            <div class="outer-container clearfix">
                  <!--Logo Box-->
                  <div class="logo-box">

                      <div class="logo">
                        <a href="/">
                          <?php if(isset($this->params['headerClass'])): ?>
                            <img src="/images/logo-1.png" alt="">
                          <?php else: ?>
                            <img src="/images/logo-1-black.png" alt="">
                            
                          <?php endif; ?>
                        </a>
                      </div>
                  </div>
                  
                  <!--Nav Outer-->
                  <div class="nav-outer clearfix">
                      <!-- Main Menu -->
                      <nav class="main-menu">
                          <div class="navbar-header">
                              <!-- Toggle Button -->      
                              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                              </button>
                          </div>
                          <div class="navbar-collapse collapse clearfix">
                          <?=
                            Menu::widget([
                              'items' => [
                                ['label'=>'Главная','url'=>['/site/index']],
                                ['label'=>'Цены','url'=>Yii::$app->urlManager->createUrl(['/site/index','#'=>'pricing'])],
                                ['label'=>'API','url'=>['/api/index']],
                                //['label'=>'Поддержка','url'=>'/support/index'],
                                ['label'=>'Вход','url'=>User::getLoginUrl(),'visible'=>Yii::$app->user->isGuest],
                                ['label'=>(Yii::$app->user->isGuest?'':Yii::$app->user->identity->fullName).((Yii::$app->user->isGuest || Yii::$app->user->identity->msgCount==0)?'':' <span class="badge  badge-warning">'.Yii::$app->user->identity->msgCount.'</span>'),'url'=>User::getLogoutUrl(),'visible'=>!Yii::$app->user->isGuest,'options'=>['class'=>'dropdown'],'items'=>[
                                  ['label'=>'Мой профиль','url'=>User::getViewProfileUrl()],
                                  ['label'=>'Добавить URL','url'=>'/request/create'],
                                  ['label'=>'Мои URL','url'=>'/request/index'],
                                  ['label'=>'Баланс '.(Yii::$app->user->isGuest?'':'<span class="pull-right ">'.Yii::$app->formatter->asCurrency(Yii::$app->user->identity->balanse).'</span>'),'url'=> Yii::$app->user->isGuest?'#':Yii::$app->user->identity->balanseUrl,'encode'=>false],
                                  ['label'=>'Сообщения '.((Yii::$app->user->isGuest || Yii::$app->user->identity->msgCount==0)?'':'<span class="badge  badge-warning pull-right">'.Yii::$app->user->identity->msgCount.'</span>'),'url'=>Notification::getIndexUrl(),'encode'=>false],
                                  ['label'=>'Выход','url'=>User::getLogoutUrl()],
                                ],'encode'=>false],
                              ],
                              'options'=>['class'=>'navigation clearfix'],
                              'activeCssClass'=>'current'

                            ]);
                          ?>
                          </div>
                          
                      </nav>
                      <!-- Main Menu End-->
                      
                      

                      
                  </div>
                  <!--Nav Outer End-->
                  
            </div>    
          </div>
      </div>

  </header>
  <!--End Main Header -->

  <?php if(isset($this->params['title'])): ?>
  <!--Page Title-->
  <section class="page-title">
      <div class="auto-container">
          <div class="row clearfix">
              <!--Title -->
              <div class="title-column col-md-6 col-sm-8 col-xs-12">
                  <h1><?= $this->params['title']; ?></h1>
              </div>
              <!--Bread Crumb -->
              <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                  <?=
                    Breadcrumbs::widget([
                      'links' => $this->params['breadcrumbs'],
                      'options'=>['class'=>'bread-crumb clearfix'],
                    ]);
                  ?>
              </div>
              
          </div>
      </div>
  </section>
  <!--End Page Title-->
  <?php endif; ?>
  <?= $content; ?>
  
  <!--Main Footer-->
  <footer class="main-footer">
    <!--footer upper-->
    <div class="footer-upper">
        <div class="auto-container">
              <div class="row clearfix">
                  <!--Big Column-->
                  <div class="big-column col-md-6 col-sm-12 col-xs-12">
                      <div class="row clearfix">
                      
                          <!--Footer Column-->
                          <div class="footer-column col-md-7 col-sm-6 col-xs-12">
                              <div class="footer-widget about-widget">
                                  <h3><span class="theme_color">12K+</span> Парсеров<br> к Вашим услугам</h3>
                                  <div class="text">Наш принцип работы - Делать все как можно проще и удобнее за приемлемую стоимость. В первом приоритете всегда скорость, точность и надежность.</div>
                                  <ul class="social-icon-one">
                                      <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                      <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                      <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                      <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                                  </ul>
                              </div>
                          </div>
                          
                          <!--Footer Column-->
                          <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                              <div class="footer-widget links-widget">
                                  
                                   <h2>Категориии <br/> сайтов</h2>
                                  <div class="widget-content">
                                      <ul class="list">
                                          <li><a href="#">Товары & Услуги</a></li>
                                          <li><a href="#">Статьи & Новости</a></li>
                                          <li><a href="#">Соц. сети</a></li>
                                          <li><a href="#">Прочие ресурсы</a></li>
                                      </ul>
                                  </div>
                              </div>
                              
                          </div>
                          
                      </div>
                  </div>
                  <!--Big Column-->
                  <div class="big-column col-md-6 col-sm-12 col-xs-12">
                      <div class="row clearfix">
                      
                          <!--Footer Column-->
                          <div class="footer-column col-md-5 col-sm-6 col-xs-12">
                              <div class="footer-widget links-widget">
                                 <h2>Быстрые <br/> ссылки</h2>
                                  <div class="widget-content">
                                      <ul class="list">
                                          <li><a href="/site/page?view=agreement">Ползовательское соглашение</a></li>
                                          <li><a href="/ticket/create">Тех. поддержка</a></li>
                                          <li><a href="/request/create">Добавить URL</a></li>
                                          <li><a href="/order/pay">Пополнить счет</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          
                          <!--Footer Column-->
                          <div class="footer-column col-md-6 col-sm-6 col-xs-12">
                              <div class="footer-widget address-widget">
                                  <h2>Контакты</h2>
                                  <div class="widget-content">
                                      <ul class="list-style-two">
                                          <li><span class="icon">@</span><?= Yii::$app->params['contactEmail']; ?></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!--End Footer Upper-->
      
      <!--footer bottom-->
      <div class="footer-bottom">
        <div class="auto-container">
            <div class="copyright">&copy; <?= Date('Y'); ?> <a href="/">Parsim NET</a> All Rights Reserved.</div>
          </div>
      </div>
      <!--End Footer Bottom-->
      
  </footer>
  <!--End Main Footer-->
    
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-long-arrow-up"></span></div>
<?php $this->endContent(); ?>
