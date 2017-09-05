<?php
  use yii\bootstrap\ActiveForm;
  use common\behaviors\CategoryTreeBehavior;

  use backend\assets\user\FormProfileAsset;
  FormProfileAsset::register($this);

?>


<!-- 2 columns form -->
<?php $form = ActiveForm::begin(['id' => 'profile-form', 'class'=>'form-horizontal']); ?>
  <div class="panel panel-flat">
    
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <fieldset>
            <legend class="text-semibold"><i class="icon-reading position-left"></i> Personal info</legend>

            <div class="form-group">
              <label class="col-lg-3 control-label">Your name:</label>
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-md-6">
                    <?= $form->field($model, 'ownerFirstName')->textInput(['placeholder'=>Yii::t('app','First name')])->label(false); ?>
                  </div>

                  <div class="col-md-6">
                    <?= $form->field($model, 'ownerLastName')->textInput(['placeholder'=>Yii::t('app','Last name')])->label(false); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Contacts:</label>
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-md-6">
                    <?= $form->field($model, 'ownerEmail')->textInput(['placeholder'=>Yii::t('app','E-mail')])->label(false); ?>
                  </div>

                  <div class="col-md-6">
                    <?= $form->field($model, 'ownerPhone')->textInput(['placeholder'=>Yii::t('app','Phone'),'data-mask'=>'+7(999) 999-9999'])->label(false); ?>

                  </div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <div class="row mb-20">
        <div class="col-md-12">
          <fieldset>
            <legend class="text-semibold"><i class="icon-store2 position-left"></i> Organization info</legend>

            <div class="form-group">
              <label class="col-lg-3 control-label">Organization name:</label>
              <div class="col-lg-9">
                <?= $form->field($model, 'name')->textInput(['placeholder'=>Yii::t('app','Organization name')])->label(false); ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Address:</label>
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-md-3">
                    <?= $form->field($model, 'city_id')->dropDownList(
                        $model->city->getAssocList(1,CategoryTreeBehavior::SELECT_WITHOUT_CHILD),['class'=>'select-search'])->label(false);?>
                    
                  </div>

                  <div class="col-md-9">
                    <?= $form->field($model, 'address')->textInput(['placeholder'=>Yii::t('app','Address')])->label(false); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Contacts:</label>
              <div class="col-lg-9">
                <div class="row">
                  <div class="col-md-6">
                    <?= $form->field($model, 'email')->textInput(['placeholder'=>Yii::t('app','E-mail')])->label(false); ?>
                    
                  </div>

                  <div class="col-md-6">
                    <?= $form->field($model, 'phone')->textInput(['placeholder'=>Yii::t('app','Phone'),'data-mask'=>'+7(999) 999-9999'])->label(false); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Web-site</label>
              <div class="col-lg-9">
                <?= $form->field($model, 'url')->textInput(['placeholder'=>Yii::t('app','http://mySiteName.com')])->label(false); ?>
              </div>
            </div>
          </fieldset>
        </div>
      </div>

      <div class="text-right">
        <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
      </div>
    </div>
  </div>
<?php ActiveForm::end(); ?>
<!-- /2 columns form -->