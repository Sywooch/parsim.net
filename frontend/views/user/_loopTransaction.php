<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;
  
?>
<!--Our Shop-->

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Дата</th>
        <th>Описание</th>
        <th>Сумма</th>
      </tr>
    </thead>
    <tbody>
      <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_viewTransaction',
        'options'=>['class'=>'list-study'],
        'layout'=>'{items}',
        'emptyText'=>false
      ]); ?>
    </tbody>
  </table>
</div>
