<?php
  use common\models\Tarif;
  $labelClass=[
    Tarif::STATUS_DISABLED=>'label-default',
    Tarif::STATUS_ENABLED=>'label-success',
  ];
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->statusDesctiption; ?>"><?= $model->statusName; ?></span>