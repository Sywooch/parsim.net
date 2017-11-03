
<?php
  $labelClass=[
    '0'=>'label-success',
    '1'=>'label-danger',
    '2'=>'label-default',
  ]
  
?>

<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->name; ?></a></td>
  <td ><a href="<?= $model->example_url; ?>" target="blank" class="src-link"><?= $model->hostName; ?></a></td>
  <td ><?= $model->ClassName; ?></td>
  <td ><?= $model->loaderName; ?></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>" data-popup="tooltip" title data-original-title="<?= $model->err_description; ?>"><?= $model->statusName; ?></span></td>
</tr>
