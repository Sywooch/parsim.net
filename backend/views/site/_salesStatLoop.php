<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;
?>

<table class="table text-nowrap">
  <thead>
    <tr>
      <th>Application</th>
      <th>Date</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
    <?= ListView::widget([
      'dataProvider' => $dataProvider,
      'itemView' => '_salesStatView',
      'layout'=>'{items}',
      'emptyText'=>false
    ]); ?>
  </tbody>
</table>