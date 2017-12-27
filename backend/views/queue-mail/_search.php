<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Lookup;

?>

<div class="group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <?= $form->field($model, 'subject') ?>
    
    <div class="form-group">
        <div class="co-xs-12 text-right">
            <?= Html::submitButton('<i class="icon-search4 position-left"></i> '.Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
