
<?php
  $labelClass=[
    '0'=>'label-primary',
    '1'=>'label-success',
    '2'=>'label-default',
    '3'=>'label-danger',
  ]
?>

<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->host; ?></a></td>
  <td ><?= $model->class_name; ?></td>
  <td ><?= $model->loaderName; ?></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
</tr>
