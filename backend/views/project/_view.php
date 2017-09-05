<?php
  $labelClass=[
    $model::STATUS_NEW=>'label-primary',
    $model::STATUS_ENABLED=>'label-success',
    $model::STATUS_DISABLED=>'label-default',
    
  ]
?>
<tr>
  <td ><a href="<?= $model->viewUrl; ?>"><?= $model->title; ?></a></td>
  <td><?= $model->alias; ?></td>
  <td><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
</tr>
