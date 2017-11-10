<tr>
    <td><?= date('d.m.Y',$model->created_at); ?></td>
    <td><?= $model->description; ?></td>
    <td><?= Yii::$app->formatter->asCurrency($model->amount); ?></td>
</tr>