<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
//$this->params['bodyClass']="error-404 no-hero-image";
?>

<!--End Main Header -->
<!--Page Title-->
<section class="page-title">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Title -->
            <div class="title-column col-md-6 col-sm-8 col-xs-12">
                <h1><?= $name; ?></h1>
            </div>
            <!--Bread Crumb -->
            <div class="breadcrumb-column col-md-6 col-sm-4 col-xs-12">
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li class="active">404</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Error Section-->
<section class="error-section">
    <div class="auto-container">
        <div class="error-image">
            <div class="image"><img src="/images/resource/error-image.jpg" alt="" /></div>
        </div>
        <h3>Opps!! Looks like somthing went wrong</h3>
        <div class="text">The page you are looking for was moved, removed, renamed or might never existed.</div>
        <div class="error-options">
            <a href="index.html" class="theme-btn btn-style-one">Go Home</a>
            <span class="or">Or</span>
            <!-- Error Search Form -->
            <div class="error-search-box">
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Search..." required>
                        <button type="submit"><span class="icon fa fa-search"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--End Error Section-->

<!--Subscribe Style One-->
<section class="subscribe-style-one">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h2>Sign up for our newsletter to get update</h2>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <input type="email" name="email" value="" placeholder="Enter Your Email Here..." required>
                        <button type="submit" class="theme-btn"><span class="icon flaticon-send-message-button"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--End Subscribe Style One-->
