<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
//use \phpQuery;


class ParserPagination extends Model
{
  
  private $_title;
  private $_url;
  

  //============================================
  //
  // Блок Getters & Setters
  //
  //============================================
  
  //Title
  public function getTitle()
  {
    return $this->_title;
  }
  public function setTitle($value)
  {
    $this->_title=$value;
  }
  
  //Url
  public function getUrl()
  {
    return $this->_url;
  }
  public function setUrl($value)
  {
    $this->_url=$value;
  }
  

  public function rules()
  {
      return [
          //[['title'], 'required'],
          [['title','url'], 'string'],
      ];
  }
  

  public function fields()
  {
    return [
      'title',
      'url',
    ];
  }
}
