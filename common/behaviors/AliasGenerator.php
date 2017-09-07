<?php
namespace common\behaviors;

use yii;
use yii\db\Expression;
use yii\base\Behavior;
use yii\db\ActiveRecord;

use dosamigos\transliterator\TransliteratorHelper;
use yii\helpers\Inflector;

class AliasGenerator extends Behavior
{
  
  public $src = null;
  public $dst = 'alias';
  public $translit = true;

  public function events()
  {
    return [
      ActiveRecord::EVENT_BEFORE_INSERT => 'setAlias',
      ActiveRecord::EVENT_BEFORE_UPDATE => 'setAlias'
    ];
  } 

  public function setAlias($event)
  {
    if(empty($this->owner->{$this->src}) || $this->src==null){
      if (empty($this->owner->{$this->dst} )){
        $this->owner->{$this->dst} = uniqid();
      }
    }else{
      if ( empty($this->owner->{$this->dst} ) ) {
        $this->owner->{$this->dst} = $this->generateAlias( $this->owner->{$this->src} );
      } else {
        $this->owner->{$this->dst} = $this->generateAlias( $this->owner->{$this->src} );
      }  
    }
    
  }

  private function generateAlias( $alias )
  {
    $alias = $this->slugify( $alias );
    if ( $this->checkUniqueAlias( $alias ) ) {
      return $alias;
    } else {
      for ( $suffix = 2; !$this->checkUniqueAlias( $new_alias = $alias . '-' . $suffix ); $suffix++ ) {}
      return $new_alias;
    }
  }

  private function slugify( $alias )
  {
    if ( $this->translit ) {
      return Inflector::slug( TransliteratorHelper::process($alias), '-', true );
    } else {
      return $this->slug( $alias, '-', true );
    }
  }

  private function slug( $string, $replacement = '-', $lowercase = true )
  {
    $string = preg_replace( '/[^\p{L}\p{Nd}]+/u', $replacement, $string );
    $string = trim( $string, $replacement );
    return $lowercase ? strtolower( $string ) : $string;
  }

  private function checkUniqueAlias( $alias )
  {
    $pk = $this->getPrimaryKeyAttribute();

    $condition = $this->dst . ' = :alias ';
    $params = [ ':alias' => $alias];
    if ( !$this->owner->isNewRecord ) {
      $condition .= ' and ' . $pk . ' != :pk';
      $params[':pk'] = $this->owner->{$pk};
    }

    return !$this->owner->find()
      ->where( $condition, $params )
      ->one();
  }

  protected $_primaryKey;
  protected function getPrimaryKeyAttribute()
  {
      if ($this->_primaryKey === null){
        $this->_primaryKey = $this->owner->primaryKey();
          $this->_primaryKey =$this->_primaryKey[0];
      }
      return $this->_primaryKey;
  }

 
  
}
?>