<tr>
  <td><?= $seq; ?></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td><?= $model->json ?></td>
  <td><?= $model->statusName ?></td>
</tr>