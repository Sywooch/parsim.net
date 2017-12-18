<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
use \phpQuery;


class ParserTask extends BaseParser
{
  
  private $_id;
  private $_price;
  private $_name;
  private $_description;
  private $_type;
  private $_date;
  private $_views;
  private $_answers;
  private $_isHot;
  private $_viewURL;
  


  //============================================
  //
  // Блок Getters & Setters
  //
  //============================================
  
  //ID
  public function getId()
  {
    return $this->_id;
  }
  public function setId($value)
  {
    $this->_id=$value;
  }

  //Price
  public function getPrice()
  {
    return $this->_price;
  }
  public function setPrice($value)
  {
    $this->_price=$value;
  }
  
  //Name
  public function getName()
  {
    return $this->_name;
  }
  public function setName($value)
  {
    $this->_name=$value;
  }

  //Description
  public function getDescription()
  {
    return $this->_description;
  }
  public function setDescription($value)
  {
    $this->_description=$value;
  }

  //Type
  public function getType()
  {
    return $this->_type;
  }
  public function setType($value)
  {
    $this->_type=$value;
  }

  //Date
  public function getDate()
  {
    return $this->_date;
  }
  public function setDate($value)
  {
    $this->_date=$value;
  }

  //Views
  public function getViews()
  {
    return $this->_views;
  }
  public function setViews($value)
  {
    $this->_views=$value;
  }

  //Answers
  public function getAnswers()
  {
    return $this->_answers;
  }
  public function setAnswers($value)
  {
    $this->_answers=$value;
  }

  //isHot
  public function getIsHot()
  {
    return $this->isHot;
  }
  public function setIsHot($value)
  {
    $this->_isHot=$value;
  }

  //isHot
  public function getViewUrl()
  {
    return $this->_viewURL;
  }
  public function setViewUrl($value)
  {
    $this->_viewURL=$value;
  }
  




  public function rules()
  {
      return [
          [['price','name','description'], 'required'],
          [['id','price','name','description','type','viewUrl','date'], 'string'],
          [['views','answers'], 'string'],
      ];
  }
  

  public function fields()
  {
    return [
      'id',
      'name',
      'price',
      'description',
      'type',
      'views', 
      'answers',
      'viewUrl'
    ];
  }
}
