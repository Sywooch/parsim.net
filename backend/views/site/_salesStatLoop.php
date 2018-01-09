<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;
?>

<table class="table text-nowrap">
  <thead>
    <tr>
      <th>User</th>
      <th>Date</th>
      <th>Amount</th>
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