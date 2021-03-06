<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;
  
?>
<!--Our Shop-->
<div class="col-sm-12">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="100px">ID запроса</th>
          <th>Целевой Url</th>
          <th width="20px">Ответы</th>
          <th width="50px">Статус</th>
          <th width="120px">Создан</th>
        </tr>
      </thead>
      <tbody>
        <?= ListView::widget([
          'dataProvider' => $dataProvider,
          'itemView' => '_view',
          'options'=>['class'=>'list-study'],
          'layout'=>'{items}',
          'emptyText'=>false
        ]); ?>
      </tbody>
    </table>
  </div>
</div>  