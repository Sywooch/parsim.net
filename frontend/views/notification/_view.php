<?php

  $msg=[
    $model::TYPE_NEED_PAY=>[
      'title'=>'Недостаточно средств на счете',
      'class'=>'panel-danger'
    ],
  ];

?>

<div class="panel <?= $msg[$model->type]['class']; ?>"> 
  <div class="panel-heading"> 
    <h3 class="panel-title"><?= $msg[$model->type]['title']; ?></h3> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-id="<?= $model->id; ?>"><span aria-hidden="true">×</span></button>
  </div> 
  <div class="panel-body">
    <?= $model->msg; ?>
  </div> 
</div>