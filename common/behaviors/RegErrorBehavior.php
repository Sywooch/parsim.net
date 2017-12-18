<?php
namespace common\behaviors;

use yii;
use yii\db\Expression;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Error;


class RegErrorBehavior extends Behavior
{
  
  public $fields;
  public $setStatus;
  

  public function regError($code){

    $error=new Error();

    $error->code=$code;
    $error->status=Error::STATUS_NEW;

    foreach ($this->fields as $key => $value) {
      $error->$key=$this->owner->{$value};
    }

    if($error->save() && isset($this->setStatus) && is_array($this->setStatus)){

      $statusField=$this->setStatus['field'];
      $statusValue=$this->setStatus['value'];
      $this->owner->{$statusField}=$statusValue;
      $this->owner->save();

    }
  }

  
  
}
?>