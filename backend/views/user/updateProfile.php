<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\User;

$this->title = 'My profile';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_formProfile',[
  'model'=>$model
]);

?>