<?php
namespace common\behaviors;


use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Image;
use yii\web\UploadedFile;


class ImageMultiUploadBehavior extends Behavior
{
  public $imgRelation = 'images';
  public $imgIdArray = 'images_id';
  public $imgDataArray = 'images_data';

  public $tableName = 'img_table';
  public $ownerFieldName = 'owner_id';
  public $imgFieldName = 'img_id';
  public $extraData = [];
  
  public $previews=[];
  


  public function events()
  {
    return [
      ActiveRecord::EVENT_AFTER_INSERT => 'uploadImages',
      ActiveRecord::EVENT_AFTER_UPDATE => 'uploadImages'
    ];
  } 

  public function uploadImages($event)
  {
   

    $extraKeys='';
    $extraValues='';
    foreach ($this->extraData as $data) {
      $extraKeys.=$data['field'].',';
      $extraValues.=$data['value'].',';
    }
    $extraKeys=substr($extraKeys, 0,-1);
    $extraValues=substr($extraValues, 0,-1);

    
    //Удаляю устаревшие изображения
    foreach ($this->owner->{$this->imgRelation} as $old_img) {
        $old_img_id=$old_img->id;
        $isDeleted=true;

        foreach ($this->owner->{$this->imgIdArray} as $new_img_id) {
            if($new_img_id==$old_img_id){
                $isDeleted=false;
                break;
            }
        }
        if($isDeleted)
            $old_img->delete();
    }
    //Добавляю новые изображения
    foreach ($this->owner->{$this->imgDataArray} as $img_data){
        $dataToUpload=json_decode($img_data,true);
        
        $img = new Image(['scenario' => Image::SCENARIO_CREATE_BY_DATA]);
        $img->dataToUpload=$dataToUpload;
        $img->previews=$this->previews;

        if($img->save()){
            Yii::$app->db->createCommand('INSERT INTO '.$this->tableName.' ('.$this->ownerFieldName.','.$this->imgFieldName.','.$extraKeys.') VALUES ('.$this->owner->id.','.$img->id.','.$extraValues.')')->execute();
        }
    }
  }
  
}
?>


