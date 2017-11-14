<?php

use common\models\SignupForm;
use common\models\Tarif;
use common\models\Order;


$this->title = 'Parsim NET';
$this->params['headerClass']="main-header";

?>

<?= $this->render('_mainSlider'); ?>

<!--Services Section-->
<section class="services-section" >
  <div class="auto-container">
      
        
        <?php
            echo $this->render('_serviceBlocks');
        ?>
        
        
        <div id="demo-request-area">
        <!--Request Form-->
        <?= $this->render('/request/_formTest',['model'=>$request]); ?>
        <!--End Request Form-->    
        </div>
        
        
        
    </div>
</section>
<!--End Services Section-->
<!--Business Section-->
<section class="business-section alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Image Column-->
            <div class="image-column col-md-5 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="" />
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Почемы Мы лучшие для Вашего бизнеса!!</h2>
                    <div class="dark-text">
                        Мы ценим время и убеждены, что всю рутину должны делать роботы. Мы знаем как это сделать и може избавить Вас от необходимости в этом разбираться. Так, что Вы сможете сфокусироваться только на своем бизнесе.
                    </div>
                    <ul class="list-style-one">
                        <li>Мы не берем абонентской платы! Вы всегда оплачиваете только результативные итерации парсинга.</li>
                        <li>Мы постоянно совершенствуем наши алгоритмы, что означает, что Вы всегда будете получать лучшие и лучшие результаты!</li>
                        <li>Мы - комадна высококвалифицированных IT специалистов, инновации являются неотъемлемой частью нашей бизнес-модели.</li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Business Section-->

<!--Marketing Section-->
<section class="business-section alternate">
    <div class="auto-container">
        
        <div class="row clearfix">
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <h2>Как работает Parsim<span class="theme_color"> NET</span>?</h2>
                    <div class="dark-text">
                        Мы постарались максимально упростить работу с парсером. Для начала работы Вам потребуется совершить несколько простых шагов.
                    </div>
                    <ul class="list-style-one">
                        <li>Зарегистрировать свой аккаунт.</li>
                        <li>Пополнить лицевой счет удобным для Вас способом.</li>
                        <li>В личном кабинете добавить ссылки для парсинга и указать частоту их обработки.</li>
                        <li>Вы можете использовать наш API для автоматизации перечисленных действий и интеграции со своими системами.</li>
                    </ul>
                    
            </div>

            <!--Image Column-->
            <div class="image-column col-md-5 col-md-offset-1 col-sm-12 col-xs-12">
                
                <div class="crumina-module crumina-our-video">
                    <div class="video-thumb">
                        <div class="image"><img src="/images/resource/how-it-work.png" alt="video"></div>
                        <a href="https://www.youtube.com/watch?v=wnJ6LuUFpMo" class="video-control js-popup-iframe">
                            <img src="/images/resource/play.png" alt="play">
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--End Marketing Section-->

<!--Price Section -->
<section class="business-section alternate light-bg" id="pricing">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Image Column-->
            <div class="image-column col-md-5 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="" />
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Цена - <?=Yii::$app->formatter->asCurrency(Tarif::getDefaultPrice()); ?> за результат!!</h2>
                    <div class="dark-text">
                        Для начала работы необходимо пополнить лицевой счет. Списание средств будет происходить по результатам успешных итераций парсинга.
                    </div>
                    <ul class="list-style-one">
                        <li>Никакой абоненетской платы! Вы платите только за результат.</li>
                        <li>Контролируйте бюджета в реальном времени. Меняйте количество ссылок для парсинга и частоту их обработки.</li>
                        <li>Принимаем оплату банковскими картами, электронными деньгами, банковские переводы.</li>
                    </ul>
                    <a href="<?= Order::getPayUrl(); ?>" class="theme-btn btn-style-one">Пополнить счет</a>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Price Section-->

<?php if(Yii::$app->user->isGuest): ?>
<!--Create  account-->
<section class="login-section alternate ">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Form Column-->
            <div class="col-md-5 col-sm-12 col-xs-12">
               <?= $this->render('/user/_signupForm',['model'=>$newUser,'autofocus'=>false]); ?>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Создай бесплатный аккаунт и попробуй работу парсера</h2>
                    <div class="dark-text">Для регистрации достаточно указать Ваш E-mail и придумать пароль.</div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Create  account-->
<?php endif; ?>

<!--Subscribe Style One-->
<section class="subscribe-style-one">
  <div class="auto-container">
      <div class="row clearfix">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h2><?= Yii::t('app','Sign up for our newsletter to get update'); ?></h2>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="<?= Yii::t('app','Enter your E-mail'); ?> ..." required>
                        <button type="submit" class="theme-btn"><span class="icon flaticon-send-message-button"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--End Subscribe Style One-->