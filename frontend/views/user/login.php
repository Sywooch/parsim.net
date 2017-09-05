<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;

$this->params['htmlClass']="cover";
$this->params['bodyClass']="login";

?>

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