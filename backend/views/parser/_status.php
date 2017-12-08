<?php
  $labelClass=[
    '0'=>'label-success',
    '1'=>'label-danger',
    '2'=>'label-default',
  ]
  
?>
<span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->err_description; ?>"><?= $model->statusName; ?></span>