<?php
namespace common\behaviors;

use dosamigos\transliterator\TransliteratorHelper;
use yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;

class CategoryBehavior extends Behavior
{
  public $srcAttribute = 'title';
  public $translit = true;
  
  /**
   * @var string model attribute used for showing title
   */
  public $titleAttribute = 'title';
  /**
   * @var string model attribute, which defined alias
   */
  public $aliasAttribute = 'alias';
  /**
   * @var string model property, which contains url.
   * Optionally your model can have 'url' attribute or getUrl() method,
   * which construct correct url for using our getMenuList().
   */
  public $urlAttribute = 'url';
  /**
   * @var string model property, which contains icon.
   * Optionally for 'image' value your model can have 'image' attribute or getImage() method,
   * which construct correct url for using our getMenuList().
   */
  public $iconAttribute;
  /**
   * @var string model property, which return true for active menu item.
   * Optionally declare own getLinkActive() method in your model.
   */
  public $linkActiveAttribute = 'linkActive';
  /**
   * @var string set this request property if you can use default getLinkActive() method
   */
  public $requestPathAttribute = 'path';


  /**
   * @var string model attribute
   */
  public $lngAttribute = 'lng';
  
  /**
   * @var array default criteria for all queries
   */
  public $defaultCriteria = array();

  protected $_primaryKey;
  protected $_tableSchema;
  protected $_tableName;
  protected $_criteria;



  public function events()
  {
    return [
      //ActiveRecord::EVENT_BEFORE_VALIDATE => 'getAlias'
    ];
  } 

  public function getAlias($event)
  {
    if ( empty( $this->owner->{$this->aliasAttribute} ) ) {
      $this->owner->{$this->aliasAttribute} = $this->generateAlias( $this->owner->{$this->srcAttribute} );
    } else {
      $this->owner->{$this->aliasAttribute} = $this->generateAlias( $this->owner->{$this->aliasAttribute} );
    }
  }

  

  /**
   * Return primary keys of all items
   * @return array
   */
  public function getArray()
  {
      /*
      $criteria = $this->getOwnerCriteria();
      $criteria->select = $this->primaryKeyAttribute;

      $command = $this->createFindCommand($criteria);
      $result = $command->queryColumn();
      $this->clearOwnerCriteria();
      */
      return $this->owner->find()->select($this->primaryKeyAttribute)->asArray()->all();
  }

  /**
   * Returns associated array ($id=>$title, $id=>$title, ...)
   * @return array
   */
  public function getAssocList()
  {
      $this->cached();

      $items = $this->getFullAssocData(array(
          $this->primaryKeyAttribute,
          $this->titleAttribute,
      ));

      $result = array();
      foreach($items as $item){
          $result[$item[$this->primaryKeyAttribute]] = $item[$this->titleAttribute];
      }

      return $result;
  }

  /**
   * Returns associated array ($alias=>$title, $alias=>$title, ...)
   * @return array
   */
  public function getAliasList()
  {
      $this->cached();

      $items = $this->getFullAssocData(array(
          $this->aliasAttribute,
          $this->titleAttribute,
      ));

      $result = array();
      foreach($items as $item){
          $result[$item[$this->aliasAttribute]] = $item[$this->titleAttribute];
      }

      return $result;
  }

  /**
   * Returns associated array ($url=>$title, $url=>$title, ...)
   * @return array
   */
  public function getUrlList()
  {
      $criteria = $this->getOwnerCriteria();

      $items = $this->cached($this->owner)->find()->where($criteria)->all();

      
      $result = array();

      foreach ($items as $item){
          $result = $result + array($item->{$this->urlAttribute}=>$item->{$this->titleAttribute});
      }

      return $result;
  }

  /**
   * Returns items for zii.widgets.CMenu widget
   * @return array
   */
  public function getMenuList()
  {
      $criteria = $this->getOwnerCriteria();

      $items = $this->cached($this->owner)->find()->where($criteria)->all();

      $result = array();

      foreach ($items as $item){
          $active = $item->{$this->linkActiveAttribute};
          $result[$item->getPrimaryKey()] = array(
              'id'=>$item->getPrimaryKey(),
              'label'=>$item->{$this->titleAttribute},
              'url'=>$item->{$this->urlAttribute},
              'icon'=>$this->iconAttribute !== null ? $item->{$this->iconAttribute} : '',
              'active'=>$active,
              'itemOptions'=>array('class'=>'item_' . $item->getPrimaryKey()),
              'linkOptions'=>$active ? array('rel'=>'nofollow') : array(),
          );
      }

      return $result;
  }

  /**
   * Finds model by alias attribute
   * @param $alias
   * @return CActiveRecord model
   */
  public function findByAlias($alias)
  {
    //$lng=Yii::$app->language;
    //$model = $this->cached($this->owner)->find()->where([$this->aliasAttribute=>$alias,$this->lngAttribute=>$lng])->one();
    $model = $this->cached($this->owner)->find()->where([$this->aliasAttribute=>$alias])->one();
    return $model;
  }

  /**
   * Optional redeclare this method in your model for use (@link getMenuList())
   * or define in (@link requestPathAttribute) your $_GET attribute for url matching
   * @return bool true if current request url matches with category alias
   */
  public function getLinkActive()
  {
      return mb_strpos(Yii::$app->request->getBodyParam($this->requestPathAttribute), $this->owner->{$this->aliasAttribute}, null, 'UTF-8') === 0;
  }

  /**
   * Redeclare this method in your model for use of (@link getMenuList()) method
   * @return string
   */
  public function getUrl()
  {
      return '#';
  }

  //+
  protected function getFullAssocData($attributes)
  {
      //$criteria = $this->getOwnerCriteria();

      $attributes = $this->aliasAttributes(array_unique(array_merge($attributes, array($this->primaryKeyAttribute))));
      $select = implode(', ', $attributes);

      //$command = $this->createFindCommand($criteria);
      //$this->clearOwnerCriteria();
      
      return $this->owner->find()->select($select)->asArray()->all();

      //return $command->queryAll();
  }

  /*
  protected function createFindCommand($criteria)
  {
      $builder = new CDbCommandBuilder(Yii::app()->db->getSchema());
      $command = $builder->createFindCommand($this->tableName, $criteria);
      return $command;
  }
  */

  //+
  protected function cached($model=null)
  {
      if ($model === null)
          $model = $this->owner;

      //$connection = Yii::$app->db;//$model->getDbConnection();
      return $model;//->cache($connection->queryCachingDuration);
  }

  //Возвращает массив атрибутов
  protected function aliasAttributes($attributes)
  {
      $aliasesAttributes = array();
      foreach ($attributes as $attribute) {
          $aliasesAttributes[] = $attribute;
      }
      return $aliasesAttributes;
  }

  //+
  protected function getPrimaryKeyAttribute()
  {
      if ($this->_primaryKey === null){
        $this->_primaryKey = $this->owner->primaryKey();
          $this->_primaryKey =$this->_primaryKey[0];
      }
      return $this->_primaryKey;
  }

  
  //+
  protected function getTableName()
  {
      if ($this->_tableName === null)
          $this->_tableName = $this->owner->tableName();
      return $this->_tableName;
  }

  //+-
  protected function getOwnerCriteria()
  {
      //$criteria = clone $this->owner->getDbCriteria();
      //$criteria->mergeWith($this->defaultCriteria);
      //$this->_criteria = clone $criteria;
      return null;
  }
  
  /*
  protected function clearOwnerCriteria()
  {
      $this->owner->setDbCriteria(new CDbCriteria());
  }
  */
  

  protected function getOriginalCriteria()
  {
      return $this->_criteria;
  }

  public function getIndexUrl(){
      return Yii::$app->urlManager->createUrl(strtolower(\yii\helpers\StringHelper::basename(get_class($this->owner))).'/index');
  }
  public function getCreateUrl(){
      return Yii::$app->urlManager->createUrl(strtolower(\yii\helpers\StringHelper::basename(get_class($this->owner))).'/create');
  }
  public  function getDeleteUrl(){
      $pk = $this->getPrimaryKeyAttribute();
      return Yii::$app->urlManager->createUrl([strtolower(\yii\helpers\StringHelper::basename(get_class($this->owner))).'/delete',$pk=>$this->owner->$pk]);
  }
  public  function getUpdateUrl(){
      $pk = $this->getPrimaryKeyAttribute();
      return Yii::$app->urlManager->createUrl([strtolower(\yii\helpers\StringHelper::basename(get_class($this->owner))).'/update',$pk=>$this->owner->$pk]);
  }
  public  function getViewUrl(){
      $pk = $this->getPrimaryKeyAttribute();
      return Yii::$app->urlManager->createUrl([strtolower(\yii\helpers\StringHelper::basename(get_class($this->owner))).'/view',$pk=>$this->owner->$pk]);
  }
  
}
?>