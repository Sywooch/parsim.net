<?php
  $labelClass=[
    '0'=>'label-default',
    '1'=>'label-primary',
    '2'=>'label-success',
    '3'=>'label-danger',
  ]
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->statusInfo; ?>"><?= $model->statusName; ?></span>