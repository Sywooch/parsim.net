<?php
  use common\models\Request;

  $labelClass=[
    Request::STATUS_READY=>'label-primary',
    Request::STATUS_PROCESSING=>'label-primary',
    Request::STATUS_SUCCESS=>'label-success',
    Request::STATUS_ERROR=>'label-danger',
    Request::STATUS_NEED_PAY=>'label-varning',
    Request::STATUS_FIXING=>'label-default',

    
  ]
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->statusInfo; ?>"><?= $model->statusName; ?></span>