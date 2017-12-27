
<tr>
  <td ><a href="<?= $model->updateUrl; ?>"><?= $model->email; ?></a></td>
  <td><?= $model->role; ?></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td ><a href="<?= $model->requestsUrl; ?>"><?= count($model->requests); ?></a></td>  
  <td ><a href="#"><?= $model->tarifName; ?></a></td>   
  <td ><a href="#"><?= Yii::$app->formatter->asCurrency($model->balanse); ?></a></td>  
  <td ><a href="#"><?= Yii::$app->formatter->asCurrency($model->totalIn); ?></a></td>  
  <td ><a href="#"><?= Yii::$app->formatter->asCurrency($model->totalOut); ?></a></td>  
  <td id="col-status"><?= $this->render('_status',['model'=>$model]); ?></td>
  <td class="text-center">
    <ul class="icons-list">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="icon-menu9"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right overflow-visible" >
          <li><a href="<?= $model->updateUrl; ?>"><i class="icon-pencil7"></i> Edit</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-delete"><i class="icon-bin"></i> Delete</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-disable"><i class="icon-eye-blocked"></i> Disable</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-enable"><i class="icon-eye"></i> Enable</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
