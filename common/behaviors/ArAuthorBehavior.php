<?php
namespace common\behaviors;

use yii;
use yii\db\Expression;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class ArAuthorBehavior extends Behavior
{
  
  public $created_by = 'created_by';
  public $updated_by = 'updated_by';
  
  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_INSERT => 'setCreator',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'setEditor'
    ];
  } 

  public function setCreator($event){
    $this->owner->{$this->created_by}=Yii::$app->user->identity->id;
    $this->setEditor($event);
  }

  public function setEditor($event){
    $this->owner->{$this->updated_by}=Yii::$app->user->identity->id;    
  }

 
  
}
?>