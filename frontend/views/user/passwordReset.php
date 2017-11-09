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
                
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <div class="login-content">
                    <h2><?= $this->title; ?></h2>
                    <div class="dark-text">When we first get to know you, we’ll immediately begin analyzing your website. We want to know everything we can about it.</div>
                    <?php $form = ActiveForm::begin([
                        'id' => 'reset-form',
                    ]); ?>
                        <div class="row clearfix">
                          <div class="column col-md-9 col-sm-12 col-xs-12">
                                <?php echo $form->field($model, 'password')->passwordInput(['autofocus' => true,'placeholder'=>Yii::t('app','Enter new password...')])->label(false); ?>
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
