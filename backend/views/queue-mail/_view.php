<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->subject; ?></a></td>
  <td><?= $model->attempts; ?></td>
  <td><?= $model->last_attempt_time; ?></td>
  <td><?= $model->sent_time; ?></td>
  <td><?= $model->time_to_send; ?></td>
  <td><?= $model->created_at; ?></td>
  <td class="text-center">
    <ul class="icons-list">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="icon-menu9"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="<?= $model->updateUrl; ?>"><i class="icon-pencil7"></i> Edit</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-delete"><i class="icon-bin"></i> Delete</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
