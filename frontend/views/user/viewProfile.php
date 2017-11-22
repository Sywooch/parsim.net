<?php

/* @var $this yii\web\View */

//use yii\helpers\Html;
//use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
//use common\models\Lookup;

$this->title='Мой профиль';
$this->params['title']=$this->title;
  

//$this->params['breadcrumbs'][] = ['label' => 'Мои URL', 'url' => $model->indexUrl];
//$this->params['breadcrumbs'][] = ['label' => $model->alias, 'url' => $model->viewUrl];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="user-profile">
    <div class="row clearfix">
        <div class="column col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="user-email"><?= $model->getAttributeLabel('first_name'); ?></label>
                <div class="field-value"><?= $model->first_name; ?></div>
            </div>
        </div>
        <div class="column col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="user-email"><?= $model->getAttributeLabel('last_name'); ?></label>
                <div class="field-value"><?= $model->last_name; ?></div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="column col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="user-email"><?= $model->getAttributeLabel('email'); ?></label>
                <div class="field-value"><?= $model->email; ?></div>
            </div>
        </div>
        <div class="column col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="user-email"><?= $model->getAttributeLabel('phone'); ?></label>
                <div class="field-value"><?= $model->phone; ?></div>
            </div>
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
        <a href="<?= $model->updateProfileUrl; ?>" class="theme-btn btn-style-two  submit pull-right">Изменить</a>
      </div>
    </div>
</div>
