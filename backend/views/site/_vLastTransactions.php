
<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;

  use yii\widgets\ActiveForm;

  $dataProvider=$model->search(Yii::$app->request->queryParams);
  $amountTotal=$model->getAmountTotal(Yii::$app->request->queryParams);
?>

<div class="panel panel-flat">
  <div class="panel-heading">
    <h6 class="panel-title">Транзакции</h6>
    <div class="heading-elements">
      <span class="heading-text"><span class="text-bold text-danger-600 position-right"><?= Yii::$app->formatter->asCurrency($amountTotal);?></span></span>
      <button type="button" class="btn btn-link transactionPeriod heading-btn text-semibold">
        <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
      </button>
    </div>
  </div>

  <div class="panel-body">
    <div class="content-group-xs text-center" id="transaction-spinner"></div>
    <div class="table-responsive" id="transaction-items">
      <table class="table text-nowrap">
        <thead>
          <tr>
            <th>Пользователь</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Сумма</th>
          </tr>
        </thead>
        <?= ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_vLastTransactionsItem',
          'layout'=>'{items}',
          'emptyText'=>false,
          'options'=>['class'=>'','tag'=>'tbody'],
          'itemOptions'=>['tag'=>'tr']
        ]); ?>
      </table>
    </div>
  </div>

  
</div>

<div class="hidden">
  <?php $form = ActiveForm::begin([
      'id' => 'transaction-search-form',
  ]); ?>
  <?= $form->field($model, 'begin')->textInput(['id'=>'date-begin']); ?>
  <?= $form->field($model, 'end')->textInput(['id'=>'date-end']); ?>
  <?php ActiveForm::end(); ?>
</div>