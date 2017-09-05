<?php
  use common\models\Post;
  use common\models\Category;
  use yii\helpers\Html;
?>
<aside id="categories-2" class="widget widget_categories">
  <h3 class="widget-title"><?= Yii::t('app','Topics'); ?></h3>
  <ul>
    <?php foreach ($items as $item){
      $url=Post::getCategoryPostsUrl($item->alias);
      if($item->type==Category::TYPE_INFORMATION){
        $url=$item->getInfoUrl();
      }
      echo Html::beginTag('li',['class'=>'cat-item']);
      echo Html::a($item->name,$url);
      echo Html::beginTag('li');
    }?>
  </ul>
</aside>