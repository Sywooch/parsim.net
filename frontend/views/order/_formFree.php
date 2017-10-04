<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\order */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="order-section alternate light-bg">
    <div class="auto-container">
        <div class="row clearfix">
            
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <div class="image">
                    <img src="/images/resource/business-img.png" alt="">
                </div>
            </div>
            
            <!--Content Column-->
            <div class="content-column col-md-6 col-sm-12 col-xs-12">
                <div class="login-content">
                    <div class="order-form">
                        <h2>Тариф: <?= $model->tarif->name; ?></h2>
                        <div class="dark-text">Тариф начнет свое действие сразу после нажатия кнопки подключить.</div>

                        <?php $form = ActiveForm::begin(); ?>
                        <div class="form-group">
                            <?= Html::submitButton('Подключить', ['class' => 'btn-block theme-btn btn-style-two']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

