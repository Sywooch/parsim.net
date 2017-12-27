<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\searchForms\DirectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <?= $form->field($model, 'url') ?>
    <?= $form->field($model, 'alias') ?>
    <?= $form->field($model, 'request_id') ?>

    <?= 
        $form->field($model, 'status',['template'=>'{label}{input}{error}'])->checkboxList(Lookup::items('RESPONSE_STATUS'),['item'=>function ($index, $label, $name, $checked, $value){
          return '
            <div class="checkbox mb-20">
              <label>
                <span>
                <input type="checkbox" name="'.$name.'" class="styled" '.($checked==1?'checked=""checked':'').' value='.$value.'>
                <span>
                '.$label.'
              </label>
            </div>
          ';
        }]); 
    ?>
    <div class="form-group">
        <div class="co-xs-12 text-right">
            <?= Html::submitButton('<i class="icon-search4 position-left"></i> '.Yii::t('app', 'Search'), ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
