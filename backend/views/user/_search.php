<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Lookup;

/* @var $this yii\web\View */
/* @var $model common\models\searchForms\DirectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'first_name') ?>
    <?= $form->field($model, 'last_name') ?>
    <?= 
        $form->field($model, 'status',['template'=>'{label}{input}{error}'])->checkboxList(Lookup::items('USER_STATUS'),['item'=>function ($index, $label, $name, $checked, $value){
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

    <?= 
        $form->field($model, 'role',['template'=>'{label}{input}{error}'])->checkboxList($model->roles,['item'=>function ($index, $label, $name, $checked, $value){
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
