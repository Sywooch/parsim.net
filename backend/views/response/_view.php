<?php
  $labelClass=[
    $model::STATUS_READY=>'label-success',
    $model::STATUS_LOADING=>'label-primary',
    $model::STATUS_LOADING_SUCCESS=>'label-success',
    $model::STATUS_LOADING_ERROR=>'label-danger',
    $model::STATUS_PARSING=>'label-primary',
    $model::STATUS_PARSING_SUCCESS=>'label-success',
    $model::STATUS_PARSING_ERROR=>'label-danger',
  ]
?>
<tr>
  <td ><a href="<?= $model->viewUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td ><?= $model->request->request_url; ?></td>
  <td ><?= $model->json; ?></td>
  <td ><?= $model->responseTo; ?></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
</tr>
