<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
use \phpQuery;


class ParserAccount extends BaseParser
{
  
  private $_login;
  private $_name;
  private $_regDate;
  private $_viewURL;

  

  //============================================
  //
  // Блок Getters & Setters
  //
  //============================================
  
  //ID
  public function getLogin()
  {
    return $this->_login;
  }
  public function setLogin($value)
  {
    $this->_login=$value;
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
  
  //regDate
  public function getRegDate()
  {
    return $this->_regDate;
  }
  public function setRegDate($value)
  {
    $this->_regDate=$value;
  }

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
          [['login'], 'required'],
          [['login','regDate','name'], 'string'],
      ];
  }
  

  public function fields()
  {
    return [
      'login',
      'name',
      'regDate'
    ];
  }
}
