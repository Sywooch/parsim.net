<?php
  $labelClass=[
    '0'=>'label-primary',
    '1'=>'label-success',
    '2'=>'label-default',
  ]
?>
<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td ><a href="<?= $model->target_url; ?>" class="src-link"><?= $model->target_url; ?></a></td>
  <td ><a href="<?= $model->aviso_url; ?>" class="src-link"><?= $model->aviso_url; ?></a></td>
  <td ><?= $model->statusName; ?></td>
</tr>
