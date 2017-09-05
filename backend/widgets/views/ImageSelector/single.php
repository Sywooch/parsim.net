<?php
  use yii\helpers\Html;
  use common\models\Image;


  $backgroundImage=$defaultPrviewImage;
  if($showPreview && is_int($model->$fileIdAttr)){
    $image=Image::findOne($model->$fileIdAttr);

    if(isset($image)){
      $backgroundImage=$image->getImgSrc($previewSize,$previewOptions);
    }
  }

  $showLabel=true;
  if(is_int($model->$fileIdAttr)){
    $showLabel=false;
  }

?>


<div class="thumbnail">
  <div class="thumb <?= $options['class']; ?> single-upload-place" id="<?= $id; ?>">
    <img src="<?= $backgroundImage; ?>" alt="" class="" data-default-src="<?= $defaultPrviewImage; ?>">
    <div class="caption-overflow">
      <span>
        
        
        <button type="button" id="btn-add-file" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-add-single-file"><?= $addBtnTitle; ?></button>
        <button type="button" id="btn-remove-file" class="btn border-white text-white btn-flat btn-icon btn-rounded btn-delete-single-file"><?= $deleteBtnTitle; ?></button>    
      </span>
    </div>
    <div class="hidden hidden-area">
      <?= Html::activeFileInput($model, $fileInputAttr,['class'=>'hidden signle-file-input', 'id'=>$fileInputAttr]); ?>
      <?= Html::activeHiddenInput($model, $fileIdAttr,['class'=>'signle-file-id', 'id'=>$fileIdAttr]); ?>
    </div>
  </div>
</div>