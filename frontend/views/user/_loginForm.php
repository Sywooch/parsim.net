<?php
    use yii\widgets\ActiveForm;

    use common\models\User;
?>



<?php $form = ActiveForm::begin([
    'id' => 'login-form',
]); ?>
    <div class="row clearfix">
      <div class="column col-md-9 col-sm-12 col-xs-12">
            <?php echo $form->field($model, 'email')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app',Yii::t('app','Enter your E-mail').'...')])->label(false); ?>
            <?php echo $form->field($model, 'password')->passwordInput(['placeholder'=>Yii::t('app',Yii::t('app','Enter your password').'...')])->label(false); ?>
        </div>
    </div>
    <div class="row clearfix">
      <div class="column col-md-9 col-sm-12 col-xs-12">
        <button type="submit" class="theme-btn btn-style-two btn-block submit">Вход</button>
      </div>
    </div>
    <div class="row text-right">
        <div class="column col-md-9 col-sm-12 col-xs-12">
            <a href="<?= User::getSignupUrl(); ?>">Регистрация</a> | 
            <a href="<?= User::getPasswordRecoveryUrl(); ?>">Забыли пароль?</a>
        </div>
    </div>
<?php ActiveForm::end(); ?>