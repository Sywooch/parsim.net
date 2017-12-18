<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td ><a href="<?= $model->request_url; ?>" class="src-link"><?= $model->request_url; ?></a></td>
  <td ><?= $model->freqName; ?></td>
  <td ><a href="<?= $model->response_url; ?>" class="src-link"><?= $model->response_url; ?></a></td>
  <td ><a href="mailto:<?= $model->response_email; ?>" class="src-link"><?= $model->response_email; ?></a></td>
  <td ><a href="<?= $model->responsesUrl; ?>" class="src-link"><?= $model->responseCount; ?></a></td>
  <td ><?= $model->tarifName; ?></td>
  <td ><a href="<?= $model->parserUrl; ?>" class="src-link"><?= $model->parserClassName; ?></a></td>
  <td id="col-status"><?= $this->render('_status',['model'=>$model]); ?></td>
  <td class="text-center">
    <ul class="icons-list">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="icon-menu9"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right overflow-visible" >
          <li><a href="<?= $model->updateUrl; ?>"><i class="icon-pencil7"></i> Edit</a></li>
          <li><a href="#" data-id="<?= $model->alias; ?>" class="btn-delete"><i class="icon-bin"></i> Delete</a></li>
          <li><a href="#" class="btn-test" data-id="<?= $model->id; ?>"><i class="icon-file-check" ></i> Test</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
