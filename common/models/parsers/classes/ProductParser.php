<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
use \phpQuery;


class ProductParser extends BaseParser
{
  
  private $_id;
  private $_qty=1;
  private $_price;
  private $_name;
  private $_currency;
  private $_viewURL;

  public $dict=[
    'currency'=>[
      'rub'=>'rub',
      'руб.'=>'rub',
      'rur'=>'rub',
      'р.'=>'rub',
      'руб'=>'rub',
      'p'=>'rub'
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
  //Qty
  public function getQty()
  {
    return $this->_qty;
  }
  public function setQty($value)
  {
    $this->_qty=$value;
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
          [['price','name','qty'], 'required'],
          [['price','qty'], 'number'],
          [['id','name','currency','viewUrl'], 'string'],
      ];
  }
  

  public function fields()
  {
    return [
      'id',
      'name',
      'price',
      'currency',
      'viewUrl'
    ];
  }

  public function getJson()
  {
    //Возращает в JSON формате поля, которые определены
    //в функции fields()
    return json_encode($this->toArray(),JSON_UNESCAPED_UNICODE);
  }
}
