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

<div id="login">
  <h1><img src="/images/login-logo.png" alt="GoExplore!" style="max-height:200px; width:auto; max-width:100%;"></h1>
  <form id="loginform">

    <p>
      <label for="user_login">Username<br>
      <input type="text" name="log" id="user_login" class="input" value="" size="20"></label>
    </p>

    <p>
      <label for="user_pass">Password<br>
      <input type="password" name="pwd" id="user_pass" class="input" value="" size="20"></label>
    </p>

    <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>

    <p class="submit">
      <input type="submit" name="submit" id="submit" class="button button-primary button-large" value="Log In">
    </p>

  </form>
</div> <!-- /login -->