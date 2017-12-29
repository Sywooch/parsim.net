<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->name; ?></a></td>
  <td ><?= $model->timeName; ?></td>
  <td ><?= $model->price; ?></td>
  <td ><?= $model->host_limit; ?></td>
  <td ><?= $model->extra_host_price; ?></td>
  <td ><?= $model->pars_limit; ?></td>
  <td ><?= $model->extra_pars_price; ?></td>
  
  <td ><?= $model->description; ?></td>
  <td id="col-status"><?= $this->render('_status',['model'=>$model]); ?></td>
  <td id="col-visible">
    <span class="label <?= $model->visible?'label-success':'label-default'; ?>"><?= $model->visibleName; ?></span>
  </td>

  <td class="text-center">
    <ul class="icons-list">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="icon-menu9"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="<?= $model->updateUrl; ?>"><i class="icon-pencil7"></i> Edit</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-delete"><i class="icon-bin"></i> Delete</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-disable"><i class="icon-eye-blocked"></i> Disable</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-enable"><i class="icon-eye"></i> Enable</a></li>
          
        </ul>
      </li>
    </ul>
  </td>
</tr>