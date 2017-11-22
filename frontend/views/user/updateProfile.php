<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Lookup;

$this->title='Мой профиль';
$this->params['title']=$this->title;
  

//$this->params['breadcrumbs'][] = ['label' => 'Мои URL', 'url' => $model->indexUrl];
//$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="user-profile">
    <?php $form = ActiveForm::begin([
        'id' => 'profile-form',
    ]); ?>
        
        <div class="row clearfix">
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'first_name')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app',Yii::t('app','Enter your first name').'...')]); ?>
            </div>
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'last_name')->textInput(['autofocus' => true,'placeholder'=>Yii::t('app',Yii::t('app','Enter your last name').'...')]); ?>
            </div>
        </div>

        <div class="row clearfix">
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'email')->textInput(['placeholder'=>Yii::t('app',Yii::t('app','Enter your E-mail').'...')]); ?>
            </div>
            <div class="column col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'phone')->textInput(['placeholder'=>Yii::t('app',Yii::t('app','Enter your phone').'...')]); ?>
            </div>
        </div>
        <div class="row clearfix">
            <div class="column col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="user-email">API Key</label>
                    <div class="field-value"><?= $model->auth_key; ?></div>
                </div>
            </div>
            <div class="column col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="control-label" for="user-email">Тариф</label>
                    <div class="field-value"><?= $model->tarif->fullName; ?></div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
          <div class="columncol-xs-12">
            <button type="submit" class="theme-btn btn-style-two  submit pull-right">Сохранить</button>
          </div>
        </div>
        
    <?php ActiveForm::end(); ?>
</div>
