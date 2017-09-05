<?php
namespace common\behaviors;


use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Image;
use yii\web\UploadedFile;


class ImageUploadBehavior extends Behavior
{
  public $inputFile = 'imageInputFile';
  public $imagIdField = 'image_id';
  public $imageRelation = 'image';


  //public $emptyImage ='/images/frontend/blank.png';
  
  
  public $previews=[];
  


  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_INSERT => 'uploadImage',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'uploadImage'
    ];
  } 

 

  public function uploadImage($event)
  {
    

    $this->owner->{$this->inputFile} = UploadedFile::getInstance($this->owner, $this->inputFile);
    
    if(isset($this->owner->{$this->inputFile})){
      $img=new Image(['scenario' => Image::SCENARIO_CREATE_BY_FILE]);

      $img->fileToUpload=$this->owner->{$this->inputFile};
      $img->previews=$this->previews;

      if($img->save()){
          //Удаляю старое изображение
          if(isset($this->owner->{$this->imageRelation})){
            $this->owner->{$this->imageRelation}->delete();
          }
          //и присваиваю ID нового изображения
          $this->owner->{$this->imagIdField}=$img->id;
      }else{
          return false;
      }
    }else{
      $old_logo_id=$this->owner->getOldAttribute($this->imagIdField);
      //Если нужно только удалить изображение 
      if(is_int($old_logo_id) && $this->owner->{$this->imagIdField}==''){
          return Image::findOne($old_logo_id)->delete();
      }
    }
  }
  
}
?>


