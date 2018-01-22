<?php

  $alert=[
    'success'=>['cssClass'=>'text-success','icon'=>'icon-check','button'=>'btn-success','title'=>'Успешно!'],
    'error'=>['cssClass'=>'text-danger','icon'=>'icon-times-circle','button'=>'btn-danger','title'=>'Ошибка!'],
    'danger'=>['cssClass'=>'text-danger','icon'=>'icon-exclamation-triangle','button'=>'btn-danger','title'=>'Внимание!'],
    'info'=> ['cssClass'=>'text-info','icon'=>'icon-info-circle','button'=>'btn-info','title'=>'Информация'],
    'warning'=>['cssClass'=>'text-warning','icon'=>'icon-exclamation-triangle','button'=>'btn-warning','title'=>'Внимание!'],

  ];

  
?>
<div id="modalAlert" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title <?= $alert[$type]['cssClass']; ?>"><?= $alert[$type]['title']; ?></h4>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <p><?= $message; ?></p>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn <?= $alert[$type]['button']; ?> pull-right" data-dismiss="modal" type="button">Продолжить</button>
      </div>
    </div>
  </div>
</div>