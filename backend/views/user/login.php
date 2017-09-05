<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->params['bodyClass'] = 'login-container';


?>
<!-- Simple login form -->
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group"><?php echo Yii::t('app','Login to your account'); ?> <small class="display-block"><?php echo Yii::t('app','Enter your credentials below'); ?></small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <!--input type="text" class="form-control" placeholder="Username"-->
            <?php echo $form->field($model, 'email')->textInput(['autofocus' => true,'class'=>'form-control','placeholder'=>Yii::t('app','E-mail')])->label(false); ?>
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <!--input type="password" class="form-control" placeholder="Password"-->
            <?php echo $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>Yii::t('app','Password')])->label(false); ?>
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'styled']); ?>
        </div>
        
        <div class="form-group">
            <!--button type="submit" class="btn bg-pink-400 btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button-->
            <?php echo Html::submitButton(Yii::t('app','Login').' <i class="icon-circle-right2 position-right"></i>', ['class' => 'btn bg-pink-400 btn-block', 'name' => 'login-button']) ?>
        </div>

        <div class="text-center">
            <a href="<?php echo User::getSignupUrl(); ?>"><?php echo Yii::t('app','Signup'); ?></a> |
            <a href="<?php echo User::getPasswordRecoveryUrl(); ?>"><?php echo Yii::t('app','Forgot password?'); ?></a>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<!-- /simple login form -->