<?php

namespace common\models\parsers;

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
    public $charset='windows-1251';
    public $defaultAction='unknowAction';

    public $dict=[];




    public static function getParserList(){
        return [];
    }

    public function getMethods(){
        return [
            'keyWords',
        ];
    }

    //methods
    public function getKeyWords(){

        $retval=[];

        return json_encode($retval);
    }



    public static function initParser($url,$contentPath)
    {
        $model=self::loadParser(self::url2ClassName($url));
        $model->contentPath=$contentPath;
        $model->url=$url;

        //$model->charSet=

        return $model; 
    }

    public static function url2ClassName($url)
    {
        $url=parse_url($url);

        $host=str_replace('www.', '', $url['host']);
        $host=str_replace('-', '.', $host);

        $host=explode('.', $host);

        $className='';
        foreach ($host as $key => $part) {
            $className.=ucfirst(strtolower($part));
        }

        return $className;
    }

    private static function loadParser($parserName)
    {
        $parser=\yii\di\Instance::ensure(
            'common\models\parsers\\' . $parserName
        );

        return $parser;
    }

    /*
    public function getAction()
    {
        return $this->defaultAction;
    }
    */
    public function getAction()
    {   
        $className=end(explode('\\', self::className()));

        $parser=Parser::findByClassName($className);
        
        $path=parse_url($this->url, PHP_URL_PATH);

        foreach ($parser->actions as $key => $action){
            if(preg_match($action->reg_exp,$path)){
                return $action->category->name;
            }
        }
        return $this->defaultAction;
    }

    public function getUnknowAction()
    {
        //Если по URL не удалось распознать действие для парсера
        //запускается это действие и регистрирует проблему
        return 'unknowAction';
    }

}
