<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Available';
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
                <h1>available</h1>
            </div>
            <!--Bread Crumb -->
            <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li class="active">available</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->

<section class="login-section alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="">
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <div class="login-content">
                    <h2>Сорри, тариф недоступен.</h2>
                    <h2><span class="theme_color"><?= $model->name; ?></span></h2>
                    <div class="dark-text">Теперь Вы можете использовать 100% функционала сервиса абсолютно бесплатно в течении всего срока службы сервиса.</div>
                </div>
                <div class="row clearfix ">
                  <div class="column col-md-12 col-sm-12 col-xs-12">
                    <button  class="theme-btn btn-style-five btn-block mt-60">Войти в личный кабинет</button>
                  </div>
                </div>
            </div>
            
        </div>
    </div>
</section>