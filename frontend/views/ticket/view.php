<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title='Обращение #'.$model->alias;
$this->params['title']=$this->title;
  

$this->params['breadcrumbs'][] = ['label' => 'Мои обращения', 'url' => $model->indexUrl];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="ticket-view">
    <div class="row clearfix">
      <div class="ticket-column col-md-7 col-sm-12 col-xs-12">

        <div class="ticket-title">
            <h2><?= $model->subject; ?></h2>
            <div class="title-text"><?= $model->categoryName; ?></div>
        </div>
      </div>
    </div>

    <div class="messages-area">
      <div class="group-title"><h2><?= $model->messageCount; ?> сообщений</h2></div>
      <?php foreach ($model->messages as $key => $msg): ?>
      <div class="row">
        <div class="col-sm-12">
          <!--Comment Box-->
          <div class="comment-box">
              <div class="comment">
                  <div class="comment-inner">
                      <div class="comment-info clearfix"><strong><?= $msg->owner->fullName; ?></strong><div class="comment-time"><?= Yii::$app->formatter->asDate($msg->created_at); ?></div></div>
                      <div class="text"><?= $msg->message; ?></div>
                  </div>
              </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
      
</div>

<div class="comment-form">
  <!--Comment Form-->
  <?php $form = ActiveForm::begin([
      'id' => 'ticket-msg',
  ]); ?>
      <div class="row clearfix">
          <?= $form->field($message, 'message')->textArea(['maxlength' => true, 'placeholder'=>'Текст обращения','class'=>'']); ?>
          
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
              <?= Html::submitButton('Отправить сообщение', ['class' => 'theme-btn btn-style-one pull-right']) ?>
          </div>
          
      </div>
  <?php ActiveForm::end(); ?>
      
</div>
