<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use common\models\User;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\forms\LoginForm */

$this->title = 'Введите Ваш новый пароль';
$this->params['breadcrumbs'][] = $this->title;
$this->params['bodyClass'] = 'login-container';
?>
<!-- Reset password -->
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group"><?php echo Yii::t('app','Enter new password'); ?> <small class="display-block"><?php echo Yii::t('app','Enter your credentials below'); ?></small></h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <!--input type="password" class="form-control" placeholder="Password"-->
            <?php echo $form->field($model, 'password')->passwordInput(['class'=>'form-control','placeholder'=>Yii::t('app','Password')])->label(false); ?>
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        
        
        <div class="form-group">
            <?php echo Html::submitButton('Save new password <i class="icon-circle-right2 position-right"></i>', ['class' => 'btn bg-pink-400 btn-block', 'name' => 'login-button']) ?>
        </div>

        <div class="text-center">
            <a href="<?php echo User::getLoginUrl(); ?>"><?php echo Yii::t('app','Login?'); ?></a> |
            <a href="<?php echo User::getSignupUrl(); ?>"><?php echo Yii::t('app','Signup'); ?></a>
            
        </div>
    </div>
<?php ActiveForm::end(); ?>
<!-- /Reset password -->

