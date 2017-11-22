<tr>
    <td><a href="<?= $model->viewUrl; ?>"><?= $model->alias; ?></a></td></td>
    <td><?= $model->subject; ?></td>
    <td><?= Yii::$app->formatter->asDate($model->created_at); ?></td>
    <td><?= $model->statusName; ?></td>
</tr>