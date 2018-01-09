<tr>
  <td>
    <div class="media-left media-middle">
      <a href="#" class="btn bg-primary-400 btn-rounded btn-icon btn-xs">
        <span class="letter-icon">S</span>
      </a>
    </div>

    <div class="media-body">
      <div class="media-heading">
        <a href="#" class="letter-icon-title"><?= $model->owner->fullName; ?></a>
      </div>

      <div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i> 1111</div>
    </div>
  </td>
  <td>
    <span class="text-muted text-size-small"><?= Yii::$app->formatter->asDatetime($model->created_at); ?></span>
  </td>
  <td>
    <h6 class="text-semibold no-margin"><?= Yii::$app->formatter->asCurrency($model->amount); ?></h6>
  </td>
</tr>