<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
use \phpQuery;


class ProductParser extends BaseParser
{
  
  private $_login;
  private $_name;
  private $_regDate;

  

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

  public function getJson()
  {
    //Возращает в JSON формате поля, которые определены
    //в функции fields()
    return json_encode($this->toArray(),JSON_UNESCAPED_UNICODE);
  }
}
