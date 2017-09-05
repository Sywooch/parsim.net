<?php
namespace common\behaviors;

use yii;
use yii\db\Expression;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class TreeBehavior extends ListBehavior
{

  public $attrParentId = 'parent_id';
  public $attrPath = 'path';

  public $relationParent = 'parent';

  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_INSERT => 'setPath',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'setPath'
    ];
  }

  public function setPath($event)
  {
    if(empty($this->owner->{$this->attrParentId})){
      $this->owner->{$this->attrPath} = '/'.$this->owner->{$this->attrAlias};
    }else{
      $this->owner->{$this->attrPath} = $this->owner->{$this->relationParent}->{$this->attrPath}.'/'.$this->owner->{$this->attrAlias};
    }
    
  }

  public function getRoot(){
    if(empty($this->owner->{$this->attrParentId})){
      return $this->owner;
    }else{
      $pathAsArray=explode('/', $this->owner->{$this->attrPath});
      return $this->owner->findByAlias($pathAsArray[1]);
    }
  }

  
  
 
  
}
?>