<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Login';
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
                <h1>Вход</h1>
            </div>
            <!--Bread Crumb -->
            <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li class="active">Вход</li>
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
                    <h2>Вход</h2>
                    <div class="dark-text">When we first get to know you, we’ll immediately begin analyzing your website. We want to know everything we can about it.</div>
                    <?= $this->render('_loginForm',['model'=>$model]); ?>
                </div>
            </div>
            
        </div>
    </div>
</section>