<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use common\models\User;

$this->title = 'API';
$this->params['breadcrumbs'][] = $this->title;

//$this->params['htmlClass']="cover";
//$this->params['bodyClass']="login";

?>

<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Title -->
            <div class="title-column col-md-6 col-sm-8 col-xs-12">
                <h1>API</h1>
            </div>
            <!--Bread Crumb -->
            <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">API</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page-->
<div class="sidebar-page-container blog-page">
    <div class="auto-container">
        <div class="row clearfix">

            
            
            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <!--Our-Blogs-->
                <div class="our-blogs"> 
                    <div class="tab-content" id="myTabContent"> 
                        <div class="tab-pane fade active in" role="tabpanel" id="summary" aria-labelledby="summary-tab">
                            <h3>Общая схема работы</h3>
                        </div> 
                        <div class="tab-pane fade" role="tabpanel" id="api-key" aria-labelledby="api-key-tab">
                            <h3>Получение ключа API</h3>
                            <?php if(Yii::$app->user->isGuest): ?>
                                <p>Для начала работы с <?=Yii::$app->name; ?> API необходимо получить ключаутентификации. Для этого Вам необходимо зарегистрировать учетную запись. Узнать свой ключ аутенификации Вы можете в личном кабинете. Так же ключ будет Вам отправлен на E-mail в процессе регистрации.</p>
                                <div class="mt-20">
                                    <a href="<?= User::getSignupUrl(); ?>" class="theme-btn btn-style-five mr-20">Регистрация</a>    
                                    <a href="<?= User::getLoginUrl(); ?>" class="theme-btn btn-style-five">Вход</a>    
                                </div>
                            <?php else: ?>
                                <p>Все запросы к API <?=Yii::$app->name; ?> авторизуются посредствам Вашего API Key. Ниже указан Ваш API Key. Нажмите на ссылку, чтобы скопировать API Key в буфер.</p>
                                <a href="<?= Yii::$app->user->identity->getProfileUrl(); ?>" class="theme-btn btn-style-five"><?= Yii::$app->user->identity->auth_key; ?></a>    
                            <?php endif; ?>    
                        </div> 
                        
                        <div class="tab-pane fade" role="tabpanel" id="api-test" aria-labelledby="api-test-tab">
                            <h3>Как протестировать запрос</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!--Sidebar-->
            <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <aside class="sidebar blog-sidebar">
                    
                    <!-- Search Form -->
                    <div class="sidebar-widget search-box">
                        <form method="post" action="contact.html">
                            <div class="form-group">
                                <input type="search" name="search-field" value="" placeholder="Search.." required>
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                    
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2>Общая информация</h2>
                        </div>
                        <ul class="blog-cat nav nav-pills nav-stacked">
                            <li class="active"><a href="#summary" id="summary-tab" role="tab" data-toggle="tab" aria-controls="summary-tab" aria-expanded="true">Общая схема работы</a></li>
                            <li><a href="#api-key" id="api-key-tab" role="tab" data-toggle="tab" aria-controls="api-key-tab" aria-expanded="true">API Key</a></li>
                            <li><a href="#api-test" id="api-test-tab" role="tab" data-toggle="tab" aria-controls="api-test-tab" aria-expanded="true">Как протестировать запрос</a></li>
                            
                        </ul>
                    </div>
                    
                    
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2>URL</h2>
                        </div>
                        <ul class="blog-cat">
                            <li><a href="#">Добавление URL</a></li>
                            <li><a href="#">Удалить URL</a></li>
                            <li><a href="#">Запросить последний результат</a></li>
                        </ul>
                    </div>
                    
                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2>Оплата</h2>
                        </div>
                        <ul class="blog-cat">
                            <li><a href="#">Состояние счета</a></li>
                            <li><a href="#">Отчет "Начисление - Списание"</a></li>
                            <li><a href="#">Текущий тариф</a></li>
                            <li><a href="#">Сменить тариф</a></li>
                            <li><a href="#">Преречень доступных тарифов</a></li>
                        </ul>
                    </div>
                    
                </aside>
            </div>
            <!--End Sidebar-->
            
           
            
        </div>
    </div>
</div>
<!--End Sidebar Page-->