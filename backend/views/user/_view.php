<?php
  $labelClass=[
    '0'=>'label-default',
    '1'=>'label-success',
    '2'=>'label-primary',
  ]
?>
<tr>
  <td ><a href="<?= $model->updateUrl; ?>"><?= $model->email; ?></a></td>
  <td width="90%"><a href="<?= $model->updateUrl; ?>"><?= $model->first_name; ?></a></td>
  <td><?= $model->last_name; ?></td>
  <td><?= $model->role; ?></td>
  <td><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
</tr>
