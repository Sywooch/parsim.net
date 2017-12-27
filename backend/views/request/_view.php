<?php
  use common\models\Parser;
?>
<tr>
  <td ><a href="<?= $model->updateUrl; ?>" class="src-link"><?= $model->alias; ?></a></td>
  <td><?=date('d.m.y h:i:s',$model->created_at); ?></td>
  <td ><a href="<?= $model->request_url; ?>" class="src-link"><?= $model->request_url; ?></a></td>
  <td ><a href="<?= $model->parserUrl; ?>" class="src-link"><?= $model->parserClassName; ?></a></td>
  <td ><?= $model->freqName; ?></td>
  <td ><a href="<?= $model->response_url; ?>" class="src-link"><?= $model->responseTo; ?></a></td>
  <td ><a href="<?= $model->responsesUrl; ?>" class="src-link"><?= $model->responseCount; ?></a></td>
  <td ><?= $model->tarifName; ?></td>
  <td ><?= Yii::$app->formatter->asCurrency($model->owner->balanse); ?></td>
  <td ><div class="text-success"> <?= Yii::$app->formatter->asCurrency($model->amountIn); ?></div> <div class="text-danger"> <?= Yii::$app->formatter->asCurrency($model->amountOut); ?></div></td>
  <td ><a href="<?= $model->transactionsUrl; ?>" class="src-link"><?= $model->transactionsCount; ?></a></td>
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
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-test"><i class="icon-checkmark" ></i>Test parsing</a></li>
          <?php if(!isset($model->parser_id)): ?>
          <li><a href="<?= Parser::getCreateUrl($model->request_url); ?>" data-id="<?= $model->id; ?>" class="btn-test"><i class="icon-puzzle2" ></i>Add new parser</a></li>
          <?php else: ?>
          <li><a href="<?= $model->parser->updateUrl; ?>" data-id="<?= $model->id; ?>" class="btn-test"><i class="icon-puzzle2" ></i>Edit parser</a></li>
          <?php endif; ?>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-disable"><i class="icon-eye-blocked"></i> Disable</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-enable"><i class="icon-eye"></i> Enable</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-send-to-email"><i class="icon-mention" ></i> Send to test E-mail</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" class="btn-send-to-url"><i class="icon-link" ></i> Send to test URL</a></li>
          <li><a href="#" data-id="<?= $model->id; ?>" data-tarif-type="<?= $model->tarifType; ?>" class="btn-run"><i class="icon-switch2" ></i> Run</a></li>
        </ul>
      </li>
    </ul>
  </td>
</tr>
