<?php
  $labelClass=[
    '0'=>'label-default',
    '1'=>'label-primary',
    '2'=>'label-success',
    '3'=>'label-danger',
  ]
?>
<tr>
  <td ><a href="<?= $model->viewUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td ><a href="<?= $model->request_url; ?>" class="src-link"><?= $model->request_url; ?></a></td>
  <td ><?= $model->freqName; ?></td>
  <td ><a href="<?= $model->response_url; ?>" class="src-link"><?= $model->response_url; ?></a></td>
  <td ><a href="mailto:<?= $model->response_email; ?>" class="src-link"><?= $model->response_email; ?></a></td>
  <td ><a href="<?= $model->responsesUrl; ?>" class="src-link"><?= $model->responseCount; ?></a></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
</tr>
