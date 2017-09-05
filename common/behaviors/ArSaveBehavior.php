<?php
namespace common\behaviors;

use yii;
use yii\db\Expression;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class ArSaveBehavior extends Behavior
{
  
  public $created_by = 'created_by';
  public $created_at = 'created_at';

  public $updated_by = 'updated_by';
  public $updated_at = 'updated_at';
  



  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_INSERT => 'setCreator',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'setEditor'
    ];
  } 

  public function setCreator($event){
    $time=time();

    $this->owner->{$this->created_by}=Yii::$app->user->identity->id;
    $this->owner->{$this->created_at}=$time;

    $this->setEditor($event);
    
  }

  public function setEditor($event){
    $time=time();


    $this->owner->{$this->updated_by}=Yii::$app->user->identity->id;    
    $this->owner->{$this->updated_at}=$time;
    
  }

 
  
}
?>