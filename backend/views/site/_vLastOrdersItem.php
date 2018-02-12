<?php
  use common\models\Order;
  $status=[
    Order::STATUS_NEW=>'<span class="label bg-blue">Новый</span>',
    Order::STATUS_PAID=>'<span class="label bg-success">Оплачен</span>',
  ];
?>
<li class="media">
  <div class="media-left">
    <a href="<?= $model->updateUrl; ?>" class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs"><i class="icon-statistics"></i></a>
  </div>
  
  <div class="media-body">
    <?= 'Подписка с '.Yii::$app->formatter->asDate($model->begin).' по '.Yii::$app->formatter->asDate($model->end).' по тарифу '.$model->tarif->name. ' ('.Yii::$app->formatter->asCurrency($model->tarif->price).'/'.$model->tarif->time_unit.')'; ?>
    <div class="media-annotation">Создал: <?= $model->user->fullName.' '.Yii::$app->formatter->asDate($model->created_at,'short');?>, Сайтов: <?= $model->hostCount; ?>/<?= $model->tarif->host_limit; ?>, Ответов: <?= $model->resonseCount; ?>/<?= $model->tarif->pars_limit; ?></div>
  </div>

  <div class="media-right media-middle">
    <ul class="icons-list">
      <li>
        <?= $status[$model->status]; ?>
      </li>
    </ul>
  </div>
</li>