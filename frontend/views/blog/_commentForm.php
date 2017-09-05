<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\widgets\Alert;

use frontend\assets\blog\CommentFormAsset;
CommentFormAsset::register($this);
?>

<div id="respond" class="comment-respond">
  <h3 id="reply-title" class="comment-reply-title"><?= Yii::t('app','Leave a Reply'); ?> <small><a rel="nofollow" href="#" style="display:none;">Cancel Reply</a></small></h3>
  <?php $form = ActiveForm::begin([
      'id' => 'comment-form',
      'enableAjaxValidation'=>false,
      'options'=>['class' => 'comment-form']
  ]); ?>
    <p class="comment-notes"><span id="email-notes"><?= Yii::t('app','Your email address will not be published'); ?>.</span> <?= Yii::t('app','Required fields are marked'); ?> <span class="required">*</span></p>

    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'author')->textInput(['maxlength' => true,'placeholder'=>'Enter your name']); ?>  
      </div>
      <div class="col-xs-12 col-sm-6">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>'mail@domain.name']); ?>  
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12">
        <?= $form->field($model, 'url')->textInput(['maxlength' => true,'placeholder'=>'http://domain.name']); ?>  
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <?= $form->field($model, 'content')->textArea(['rows' => 10]); ?>  
      </div>
    </div>
    
    <div class="form-allowed-tags-wrapper">
      <p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:</p>
      <div class="well well-sm"><small>&lt;a href="" title=""&gt; &lt;abbr title=""&gt; &lt;acronym title=""&gt; &lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; </small></div>
    </div>
    <div id="respond-msg">
      <?php
        if(Yii::$app->session->hasFlash('success')){
          echo \yii\bootstrap\Alert::widget([
              'body' => Yii::$app->session->getFlash('success'),
              //'closeButton' => $this->closeButton,
              'options' => ['class'=>'alert-success'],
          ]);
        }
      ?>
    </div>
    <p class="form-submit">
      <?= Html::submitButton(Yii::t('app', 'Post Comment'), ['class' => 'btn-primary','id'=>'commentsubmit']) ?>
      <?= $form->field($model, 'parent_id')->hiddenInput(['id' => 'comment-parent-id'])->label(false); ?>  
      
    </p>
  <?php ActiveForm::end(); ?>
</div>

