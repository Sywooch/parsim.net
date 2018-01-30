<tr>
    <td><a href="<?= $model->getUrl('frontend','view'); ?>"><?= $model->alias; ?></a></td></td>
    <td><?= $model->request_url; ?></td>
    <td><a href="<?= $model->getUrl('frontend','responses'); ?>"><?= $model->responseCount; ?></a></td>
    <td><?= $model->statusName; ?></td>
    <td><?= Yii::$app->formatter->asDate($model->created_at); ?></td>
</tr>