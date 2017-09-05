

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



?>
<!-- 2 columns form -->
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
                <div class="col-md-12">
                  <div class="form-control-static">
                    <strong><?= $model->ownerFirstName; ?> <?= $model->ownerLastName; ?></strong> 
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Contacts:</label>
            <div class="col-lg-9">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-control-static">
                    <span><i class="icon-envelop3 position-left"></i> <?= $model->ownerEmail; ?></span>
                    <span class="pl-15"><i class="icon-phone2 position-left"></i><?= $model->ownerPhone; ?></span>
                  </div>
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
              <div class="form-control-static">
                <strong><?= $model->name; ?></strong>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Address:</label>
            <div class="col-lg-9">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-control-static">
                    <span><i class="icon-location4 position-left"></i><?= $model->city->name.', '.$model->address; ?></span>
                  </div>
                </div>

                
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Contacts:</label>
            <div class="col-lg-9">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-control-static">
                    <span><i class="icon-envelop3 position-left"></i> <?= $model->email; ?></span>
                    <span class="pl-15"><i class="icon-phone2 position-left"></i><?= $model->phone; ?></span>
                  </div>
                </div>

                
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Web-site</label>
            <div class="col-lg-9">
              <div class="form-control-static">
                <span><i class="icon-earth position-left"></i><?= $model->url; ?></span>
                
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>

    <div class="text-right">
      <a href="<?= Yii::$app->user->identity->profileUrl; ?>" class="btn btn-primary">Change <i class="icon-arrow-right14 position-right"></i></a>
    </div>
  </div>
</div>
<!-- /2 columns form -->