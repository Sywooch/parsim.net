<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = 'Сброс пароля';
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
                <div class="login-content">
                    <h2><?= $this->title; ?></h2>
                    <div class="dark-text">Укажите E-mail учетной записи, для которой Вы хотите изменить пароль.</div>
                    <?php $form = ActiveForm::begin([
                        'id' => 'reset-form',
                    ]); ?>
                        <div class="row clearfix">
                          <div class="column col-md-9 col-sm-12 col-xs-12">
                                <?php echo $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app','Enter your E-mail...')])->label(false); ?>
                            </div>
                        </div>
                        <div class="row clearfix">
                          <div class="column col-md-9 col-sm-12 col-xs-12">
                            <?= Html::submitButton('Сбросить пароль', ['class' => 'theme-btn btn-style-two btn-block submit', 'name' => 'reset-button']) ?>
                          </div>
                        </div>
                        <div class="row text-right">
                            <div class="column col-md-9 col-sm-12 col-xs-12">
                                <a href="<?= User::getLoginUrl(); ?>">Вход</a> | 
                                <a href="<?= User::getSignupUrl(); ?>">Регистрация</a>
                                
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            
        </div>
    </div>
</section>
