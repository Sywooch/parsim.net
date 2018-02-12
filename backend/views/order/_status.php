<?php
  use common\models\Order;
  $labelClass=[
    Order::STATUS_NEW=>'label-primary',
    Order::STATUS_PAID=>'label-success',
  ];
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->statusDesctiption; ?>"><?= $model->statusName; ?></span>