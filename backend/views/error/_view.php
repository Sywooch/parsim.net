<?php
  $labelClass=[
    $model::STATUS_NEW=>'label-danger',
    $model::STATUS_IN_PROGRESS=>'label-primary',
    $model::STATUS_TESTING=>'label-primary',
    $model::STATUS_FIXED=>'label-success',
  ]
?>
<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td><?=$model->htmlInfo; ?></td>
  <td><?=$model->description; ?></td>
  <td ><span class="label <?= $labelClass[$model->status]; ?>"><?= $model->statusName; ?></span></td>
  <td class="text-center">
    <ul class="icons-list">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="icon-menu9"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right overflow-visible" >
          <li><a href="<?= $model->updateUrl; ?>"><i class="icon-pencil7"></i> Edit</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-delete"><i class="icon-bin"></i> Delete</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
