<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->name; ?></a></td>
  <td ><a href="<?= $model->example_url; ?>" target="blank" class="src-link"><?= $model->hostName; ?></a></td>
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
          <li><a href="#"><i class="icon-bin"></i> Delete</a></li>
          <li><a href="#"><i class="icon-eye-blocked"></i> Disable</a></li>
          <li><a href="#" class="btn-test" data-id="<?= $model->id; ?>"><i class="icon-file-check" ></i> Test</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
