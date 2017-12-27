<?php
  use common\models\ParserType;
  $labelClass=[
    ParserType::STATUS_ENABLED=>'label-success',
    ParserType::STATUS_DISABLED=>'label-default'
  ];
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->statusDesctiption; ?>"><?= $model->statusName; ?></span>