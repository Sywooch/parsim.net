<?php
  use yii\helpers\Html;
?>

<div class="ratebox raterater-wrapper">
  <span class="<?= $cssClass; ?>">
    <?php for($i=0; $i<$maxValue; $i++){
      $item_class='fa fa-'.$symbol.' icon ';
      if($i<$value){
        $item_class.='highlighted';
      }
      echo Html::tag('i','',['class'=>$item_class]);
    }?>
  </span>
</div>