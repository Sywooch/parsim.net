<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::$app->name." - API";
//$this->params['bodyClass']="error-404 no-hero-image";
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
                    <li><a href="/">Home</a></li>
                    <li class="active">API</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--End Page Title-->

<!--Error Section-->
<section class="api-section">
    <div class="auto-container">
        <div class="row">
            <nav class="col-sm-3">
                <ul id="spyMe" class="nav">
                    <li class="">
                      <a href="#introduction">Introduction</a>
                      <ul class="nav">
                        <li class=""><a href="#introduction">Introduction</a></li>
                        <li class=""><a href="#requests">Requests</a></li>
                        <li class=""><a href="#statuses">HTTP Statuses</a></li>
                        <li class=""><a href="#responses">Responses</a></li>
                        <li class=""><a href="#meta">Meta</a></li>
                        <li class=""><a href="#links">Links</a></li>
                        <li class=""><a href="#rate-limit">Rate Limit</a></li>
                        <li class=""><a href="#curl">Curl Examples</a></li>
                        <li class=""><a href="#authentication">OAuth Authentication</a></li>
                        <li class=""><a href="#parameters">Parameters</a></li>
                        <li><a href="#cors">Cross Origin Resource Sharing</a></li>
                      </ul>
                    </li>

                    <li class="active">
                    <a href="#account">Account</a>
                      <ul class="nav">
                        <li class=""><a href="#account">Account</a></li>
                        <li class="active"><a href="#get-user-information">Get User Information</a></li>
                      </ul>
                    </li>
                </ul>
            </nav>    
        </div>
        
    </div>
</section>
<!--End Error Section-->

