<?php

namespace common\models\parsers;

use Yii;
use yii\base\Model;
use \phpQuery;


class ProductParser extends BaseParser
{
  private $_id;
  private $_price;
  private $_name;
  private $_currency;

  public $dict=[
    'currency'=>[
      'rub'=>'rub',
      'руб.'=>'rub',
      'rur'=>'rub',
      'р.'=>'rub',
      'руб'=>'rub'
    ],
  ];


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
  //Currency
  public function getCurrency()
  {
    return $this->_currency;
  }
  public function setCurrency($value)
  {
    $value=mb_strtolower($value,'UTF-8');
    if(isset($this->dict['currency'][$value])){
      $this->_currency=$this->dict['currency'][$value];
    }else{
      $this->_currency=$value;
    }
  }




  public function rules()
  {
      return [
          [['price','name'], 'required'],
          [['price'], 'number'],
          [['id','name','currency'], 'string'],
      ];
  }
  

  public function fields()
  {
    return [
      'id',
      'name',
      'price',
      'currency'
    ];
  }

  public function getJson()
  {
    //Возращает в JSON формате поля, которые определены
    //в функции fields()
    return json_encode($this->toArray(),JSON_UNESCAPED_UNICODE);
  }
}
