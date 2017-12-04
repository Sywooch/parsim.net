<?php
  $labelClass=[
    $model::STATUS_NEW=>'label-danger',
    $model::STATUS_IN_PROGRESS=>'label-primary',
    $model::STATUS_TESTING=>'label-primary',
    $model::STATUS_FIXED=>'label-success',
  ]
?>
<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td><?=$model->htmlInfo; ?></td>
  <td><?=$model->description; ?></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
</tr>
