<li class="dropdown <?= $key==0?'active':''; ?>" id="tab-<?= $key; ?>">
  <a href="#action-tab<?= $key; ?>" data-toggle="tab" class="tab-title" id="lnk-tab-<?= $key; ?>"><?= $model->name; ?></a>
  <a href="#" class="dropdown-toggle tab-menu" data-toggle="dropdown" aria-expanded="false"> <span class="caret"></span></a>
  <ul class="dropdown-menu dropdown-menu-right">
    <li><a href="#" class="btn-delete-action" data-index="<?= $key; ?>"><i class="icon-bin"></i> Delete</a></li>
  </ul>
</li>