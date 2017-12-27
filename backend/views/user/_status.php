<?php
  use common\models\User;

  $labelClass=[
    User::STATUS_BLOCKED=>'label-default',
    User::STATUS_ACTIVE=>'label-success',
    User::STATUS_WAIT=>'label-primary',
  ]
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title=""><?= $model->statusName; ?></span>
