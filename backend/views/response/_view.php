<?php

  use yii\helpers\Html;

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
  <td ><?= $model->responseTo; ?></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
  <td>
    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'alias' => $model->alias], [
        'class' => 'btn btn-danger btn-xs',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
      ]);
    ?>
  </td>
</tr>
