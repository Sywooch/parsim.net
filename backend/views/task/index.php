<div class="table-responsive content-group">
  <table class="table table-framed">
    <thead>
      <tr>
        <th class="col-xs-2">Task</th>
        <th class="col-xs-4">Src Url</th>
        <th class="col-xs-4">Dst Url</th>
        <th class="col-xs-2">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($model->children as $key => $task): ?>
      <tr>
        <td><span class="text-semibold"><a href="<?= $task->updateUrl; ?>"><?= $task->title; ?></a></span></td>
        <td><?= $task->url; ?></td>
        <td><?= $task->aviso_url; ?></td>
        <td><?= $task->statusName; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>