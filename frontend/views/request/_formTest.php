<?php
    use yii\widgets\ActiveForm;

    use frontend\assets\request\FormTestAsset;
    FormTestAsset::register($this);
?>

<div class="audit-form">
  <h2><?= Yii::t('app','Try our parser Free Now'); ?>!!</h2>
    <!--Audit Form-->
    <div class="audit-form">
        <?php $form = ActiveForm::begin([
            'id' => 'request-form',
            'action'=>'/request/create-test', 
        ]); ?>
            <div class="row clearfix">
              <div class="column col-md-9 col-sm-12 col-xs-12">
                  <div class="row clearfix">
                        <?= $form->field($model, 'request_url',['options' => ['class' => 'form-group  col-md-7 col-sm-6 co-xs-12']])->textInput(['class'=>'form-control bordered','placeholder'=>Yii::t('app','Type any website address here')])->label(false); ?>
                        <?= $form->field($model, 'response_email',['options' => ['class' => 'form-group  col-md-5 col-sm-6 co-xs-12']])->textInput(['class'=>'form-control bordered','placeholder'=>Yii::t('app','Email for answer')])->label(false); ?>

                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-4 col-xs-offset-5">
                            <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className())->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="column col-md-3 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <button id="request-submit" class="theme-btn btn-style-two"><?= Yii::t('app','Parse now'); ?></button>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>