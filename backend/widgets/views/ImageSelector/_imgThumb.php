<?php
  use yii\helpers\Html;
?>
<div class="dz-preview dz-image-preview ">  
    <div class="dz-image">
    <?php 
    if(isset($model)){
      echo $model->getImg();
      echo Html::hiddenInput($fieldName,$model->id);
    }
    ?>
    </div> 
    <a class="dz-remove mt-10 remove-pteview" href="javascript:undefined;" data-dz-remove="">Удалить файл</a>    
</div>