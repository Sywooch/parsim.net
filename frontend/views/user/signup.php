<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

//$this->params['htmlClass']="cover";
//$this->params['bodyClass']="login";

?>


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
                <div class="register-content">
                    <h2>Регистрация</h2>
                    <div class="dark-text">Укажите, пожалуйста, Ваш E-mail и пароль.</div>
                    <?= $this->render('_signupForm',['model'=>$model,'autofocus'=>true]); ?>
                </div>
            </div>
            
        </div>
    </div>
</section>