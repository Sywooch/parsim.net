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
          <th>ID запроса</th>
          <th>Целевой Url</th>
          <th>Ответов</th>
          <th>Статус</th>
          <th>Создан</th>
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