<?php
  use common\models\Order;
  $labelClass=[
    Order::STATUS_DISABLED=>'label-default',
    Order::STATUS_ENABLED=>'label-success',
  ];
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->statusDesctiption; ?>"><?= $model->statusName; ?></span>