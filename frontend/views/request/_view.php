<tr>
    <td><a href="<?= $model->getUrl('frontend','view'); ?>"><?= $model->alias; ?></a></td></td>
    <td><?= $model->request_url; ?></td>
    <td><a href="<?= $model->responsesUrl; ?>"><?= $model->responseCount; ?></a></td>
    <td><?= $model->statusName; ?></td>
</tr>