<?php

use common\models\SignupForm;




$this->title = 'оглайн парсер';
$this->params['headerClass']="main-header";

$this->params['description']='Parsim.NET — быстрый и дешевый парсер онлайн парсер'; 
$this->params['keywords']='Парсер, парсер сайтов, парсинг, парсинг сайтов, бесплатный парсер, Parsim.NET, создание парсера, парсер на заказ, парсер скачать, парсеры контента, облачный парсер, парсер новостей, парсер вк, парсер онлайн, парсер картинок, парсер товаров, парсер магазина, дешовый парсер, удобный парсер'; 


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
                    <img src="/images/resource/business-2.png" alt="" />
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Чем мы лучше других?</h2>
                    <div class="dark-text">
                        <p>
                            Мы запустили конвейер производства и централизованного мониторинга парсеров. 
                        </p>
                        <p>
                            Мы предлагаем Вам низкую стоимость и неприлично короткие сроки создания новых парсеров под Ваши потребности.
                        </p>
                        <p>
                            Вам больше не нужно искать специалистов, которые напишут под Вас парсер и будут оперативно его сопровождать и следить за изменениями на целевых страницах.
                            Все что Вам нужно сделать:
                        </p>
                    </div>
                    <ul class="list-style-one">
                        <li>Зарегистрироваться у нас на сайте.</li>
                        <li>Перечислить URL, которые хотите парсить</li>
                        <li>Пополнить счет</li>
                        
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Business Section-->

<?php
    //echo $this->render('_howItWork');
?>

<?php
    echo $this->render('_howMuch');
?>



<?php if(Yii::$app->user->isGuest): ?>
<!--Create  account-->
<section class="login-section  alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Form Column-->
            <div class="col-md-5 col-sm-12 col-xs-12">
               <?= $this->render('/user/_signupForm',['model'=>$newUser,'autofocus'=>false]); ?>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-7 col-sm-12 col-xs-12">
                <div class="inner-content">
                    <h2>Создайте бесплатный аккаунт и попробуй работу парсера</h2>
                    <div class="dark-text">Для регистрации достаточно указать Ваш E-mail и придумать пароль.</div>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Create  account-->
<?php endif; ?>

<?php
    //echo $this->render('_subscribe');
?>
