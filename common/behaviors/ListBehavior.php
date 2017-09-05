<?php
namespace common\behaviors;

use yii;
use yii\db\Expression;
use yii\base\Behavior;
use yii\db\ActiveRecord;


class ListBehavior extends Behavior
{
  
  public $attrAlias = 'alias';
  
  public function findByAlias($alias){
    return $this->owner->find()->where([$this->attrAlias=>$alias])->one();
  }
  
}
?>