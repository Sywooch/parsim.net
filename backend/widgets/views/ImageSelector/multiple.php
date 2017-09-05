<?php
  use yii\helpers\Html;
  use app\modules\media\models\Image;


  $backgroundImage=$defaultPrviewImage;
  if($showPreview){
    //$image=Image::findOne($model->$fileIdAttr);

    //if(isset($image)){
      //$backgroundImage=$image->getImgSrc($previewSize,$previewOptions);
    //}
  }

  //$showLabel=true;
  //if(is_int($model->$fileIdAttr)){
    $showLabel=false;
  //}
?>
<div class="<?= isset($options['class'])?$options['class']:''; ?> multiply-upload-place" id="<?= $id; ?>" data-field="<?= $fileDataAttr; ?>">
  <div class="dropzone" >
      <?php 
      if($showPreview){
        foreach ($model->$fileRelationAttr as $img){
          echo $this->render('_imgThumb',['model'=>$img,'fieldName'=>$fileIdAttr]);
        } 
      }
      ?>
  </div>
  <div class="wrap-buttons mt-20 text-center">
    <button type="button" class="btn bg-teal-400 btn-rounded mr-20 btn-add-multy-file"><?= $addBtnTitle; ?></button>
    <button type="button" class="btn bg-danger btn-rounded btn-delete-multy-file"><?= $deleteBtnTitle; ?></button>    
  </div>

  <div class="hidden hidden-area">
      <?= Html::fileInput('widgetInputFile',null,['multiple' => true, 'class'=>'hidden widgetInputFile', 'id'=>'widgetInputFile']);?>

      <div class="preview-template">
        <?= $this->render('_imgThumb',['model'=>null]); ?>
      </div>
  </div>
  

</div>




