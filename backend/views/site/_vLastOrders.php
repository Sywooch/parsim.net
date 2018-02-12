<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;

  use yii\widgets\ActiveForm;

  $dataProvider=$model->search(Yii::$app->request->queryParams);
  $amountTotal=$model->getAmountTotal(Yii::$app->request->queryParams);
?>
<div class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Заказы</h6>
    <div class="heading-elements">
      <span class="heading-text"><span class="text-bold text-danger-600 position-right"><?= Yii::$app->formatter->asCurrency($amountTotal);?></span></span>
      <button type="button" class="btn btn-link orderPeriod heading-btn text-semibold">
        <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
      </button>
    </div>
  </div>

  <div class="panel-body">
    <div class="content-group-xs text-center" id="order-spinner"></div>
    <div id="order-items">
      <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_vLastOrdersItem',
        'layout'=>'{items}',
        'emptyText'=>false,
        'options'=>['class'=>'media-list','tag'=>'ul'],
        'itemOptions'=>['tag'=>false]

      ]); ?>
    </div>
  </div>
</div>
<div class="hidden">
  <?php $form = ActiveForm::begin([
      'id' => 'order-search-form',
  ]); ?>
  <?= $form->field($model, 'begin')->textInput(['id'=>'date-begin']); ?>
  <?= $form->field($model, 'end')->textInput(['id'=>'date-end']); ?>
  <?php ActiveForm::end(); ?>
</div>