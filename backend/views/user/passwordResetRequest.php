
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = 'Recovery password';
$this->params['breadcrumbs'][] = $this->title;
$this->params['bodyClass'] = 'login-container';


?>

<!-- Password recovery -->
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
            <h5 class="content-group"><?php echo Yii::t('app','Password recovery'); ?> <small class="display-block"><?php echo Yii::t('app','We\'ll send you instructions in email'); ?></small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <!--input type="text" class="form-control" placeholder="Username"-->
            <?php echo $form->field($model, 'email')->textInput(['autofocus' => true,'class'=>'form-control','placeholder'=>Yii::t('app','E-mail')])->label(false); ?>
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
        
        <div class="form-group">
            <!--button type="submit" class="btn bg-pink-400 btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button-->
            <?php echo Html::submitButton(Yii::t('app','Reset password').'<i class="icon-circle-right2 position-right"></i>', ['class' => 'btn bg-pink-400 btn-block', 'name' => 'login-button']) ?>
        </div>

        <div class="text-center">
            <a href="<?php echo User::getLoginUrl(); ?>"><?php echo Yii::t('app','Login'); ?></a> |
            <a href="<?php echo User::getSignupUrl(); ?>"><?php echo Yii::t('app','Signup'); ?></a>
            
        </div>
    </div>
<?php ActiveForm::end(); ?>
<!-- /password recovery -->