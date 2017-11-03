<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
use \phpQuery;

use common\models\Parser;

class BaseParser extends Model
{
    const FORMAT_JSON = 0;
    const FORMAT_XML = 1;
    
    
    public $contentPath;
    public $url;
    

    public static function initParser($url,$contentPath)
    {
        
        $class_name=Parser::findByUrl($url)->className;

        $model=self::loadParser($class_name);
        $model->contentPath=$contentPath;
        $model->url=$url;

        //$model->charSet=

        return $model; 
    }

    private static function loadParser($parserName)
    {
        $parser=\yii\di\Instance::ensure(
            'common\models\parsers\\' . $parserName
        );

        return $parser;
    }


    //Базовые методы, которые наследуют все дочерние парсеры
    public function getKeyWords(){

        $retval=[];

        return json_encode($retval);
    }
    public function getDescription(){

        $retval=[];

        return json_encode($retval);
    }

    

}
