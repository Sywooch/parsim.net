<?php

use yii\helpers\Html;
?>
<tr>
  <td><?= $seq; ?></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td><?= $model->statusName ?></td>
  <td>
    <?= Html::a(Yii::t('app', 'Delete'), ['response-delete', 'alias' => $model->alias], [
        'class' => 'btn btn-danger btn-xs',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
      ]);
    ?>
  </td>
</tr>