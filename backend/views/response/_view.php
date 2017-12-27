<?php

  use yii\helpers\Html;

  $labelClass=[
    $model::STATUS_READY=>'label-success',
    $model::STATUS_LOADING=>'label-primary',
    $model::STATUS_LOADING_SUCCESS=>'label-success',
    $model::STATUS_LOADING_ERROR=>'label-danger',
    $model::STATUS_PARSING=>'label-primary',
    $model::STATUS_PARSING_SUCCESS=>'label-success',
    $model::STATUS_PARSING_ERROR=>'label-danger',
  ]
?>
<tr>
  <td ><a href="<?= $model->viewUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td ><?= $model->request->request_url; ?></td>
  <td ><a href="<?= isset($model->request->parser)?$model->request->parser->updateUrl:'#'; ?>"><?= $model->request->parserName; ?></a></td>
  <td ><a href="<?= isset($model->request->parser)?$model->request->parser->updateUrl:'#'; ?>"><?= $model->request->actionName; ?></a></td>
  <td ><a href="<?= $model->request->updateUrl; ?>"><?= $model->request->id; ?></a></td>
  <td ><?= $model->responseTo; ?></td>
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
          <li><a href="#" data-id="<?= $model->alias; ?>" class="btn-test"><i class="icon-checkmark" ></i>Test parsing</a></li>
          <li><a href="#" data-id="<?= $model->alias; ?>" class="btn-send-to-email"><i class="icon-mention" ></i> Send to test E-mail</a></li>
          <li><a href="#" data-id="<?= $model->alias; ?>" class="btn-send-to-url"><i class="icon-link" ></i> Send to test URL</a></li>
          <li><a href="#" data-id="<?= $model->alias; ?>" class="btn-run"><i class="icon-switch2" ></i> Run</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
