<?php
  use yii\widgets\ListView;
  use yii\widgets\LinkPager;
  
?>
<!--Our Shop-->

<?= ListView::widget([
  'dataProvider' => $dataProvider,
  'itemView' => '_view',
  'options'=>['class'=>'list-study'],
  'layout'=>'{items}'
]); ?>
