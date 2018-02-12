<?php
  $type=[
    $model::TYPE_IN=>'<span class="text-muted text-size-small text-success">'.$model->typeName.'</span>',
    $model::TYPE_OUT=>'<span class="text-muted text-size-small text-danger">'.$model->typeName.'</span>',
  ];

  $status=[
    $model::STATUS_NEW=>'<span class="text-muted text-size-small text-primary">'.$model->statusName.'</span>',
    $model::STATUS_SUCCESS=>'<span class="text-muted text-size-small text-success">'.$model->statusName.'</span>',
    $model::STATUS_FAIL=>'<span class="text-muted text-size-small text-danger">'.$model->statusName.'</span>',
  ];
?>
<td>
  <div class="media-body">
    <div class="media-heading">
      <a href="#" class="letter-icon-title"><?= $model->owner->fullName; ?></a>
    </div>

    <div class="text-muted text-size-small"><?= $model->owner->tarifName.': '.Yii::$app->formatter->asCurrency($model->owner->balanse); ?></div>
  </div>
</td>
<td>
  <?= $type[$model->type]; ?>
</td>
<td>
  <span class="text-muted text-size-small"><?= Yii::$app->formatter->asDate($model->created_at,'short'); ?></span>
</td>
<td>
  <?= $status[$model->status]; ?>
</td>
<td>
  <h6 class="text-semibold no-margin text-size-small"><?= Yii::$app->formatter->asCurrency($model->amount); ?></h6>
</td>

