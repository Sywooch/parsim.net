<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Lookup;

$this->title='Изменение пароля';
$this->params['title']=$this->title;
  

//$this->params['breadcrumbs'][] = ['label' => 'Мои URL', 'url' => $model->indexUrl];
//$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="user-change-password">
    <?php $form = ActiveForm::begin([
        'id' => 'change-password-form',
    ]); ?>
        
        <div class="row clearfix">
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'currentPassword')->passwordInput(['autofocus' => true,'placeholder'=>Yii::t('app',Yii::t('app','Enter your current password').'...')]); ?>
            </div>
        </div>

        <div class="row clearfix">
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'newPassword')->passwordInput(['placeholder'=>Yii::t('app',Yii::t('app','Enter new password').'...')]); ?>
            </div>
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'newPasswordRepeat')->passwordInput(['placeholder'=>Yii::t('app',Yii::t('app','Repeat new password').'...')]); ?>
            </div>
        </div>
        
        <div class="row clearfix">
          <div class="columncol-xs-12">
            <button type="submit" class="theme-btn btn-style-two  submit pull-right">Сохранить</button>
          </div>
        </div>
        
    <?php ActiveForm::end(); ?>
</div>
