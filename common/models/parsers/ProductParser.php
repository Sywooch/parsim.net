<?php

namespace common\models\parsers;

use Yii;
use yii\base\Model;
use \phpQuery;


class ProductParser extends BaseParser
{
  public $id;
  public $price;
  public $name;
  public $currency;

  public $dict=[
    'currency'=>[
      'rub'=>'rub',
      'руб.'=>'rub',
      'rur'=>'rub',
    ],
  ];


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
