<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->name; ?></a></td>
  <td ><a href="<?= $model->exampleUrl; ?>" target="blank" class="src-link"><?= $model->hostName; ?></a></td>
  <td ><?= $model->ClassName; ?></td>
  <td ><?= $model->loaderName; ?></td>
  <td id="col-status"><?= $this->render('_status',['model'=>$model]); ?></td>
  <td><?= $model->requestsCount; ?></td>
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
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-test"><i class="icon-checkmark" ></i>Test parsing</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-send-to-email"><i class="icon-mention" ></i> Send to test E-mail</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-send-to-url"><i class="icon-link" ></i> Send to test URL</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
