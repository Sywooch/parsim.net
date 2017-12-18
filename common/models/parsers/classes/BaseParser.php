<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;

use common\models\parsers\classes\HttpLoader; //загрузчик контента
use \phpQuery; //Parser HTNL


use common\models\Parser;
use common\models\ParserAction;
use common\models\Error;

class BaseParser extends Model
{
    //const FORMAT_JSON = 0;
    //const FORMAT_XML = 1;
    
    //const CONTENT_TYPE_LIST = 1;
    //const CONTENT_TYPE_CARD = 2;
    
    //public $url;


    public $parserAR;
    public $actionAR;
    public $requestAR;
    public $responseAR;
    public $document;
    public $charset='utf-8';

    public $errorsAR=[];

    public $testMode=false;

    public $result=[];

    /*
    public $actions=[
        'parsList'=>[
            'selectors'=>[
                'items'=>'',
                'pages'=>'',
            ],
            'test_url'=>'',
        ],
        'parsItem'=>[
            'selectors'=>[
                'item'=>'',
            ],
            'test_url'=>'',
        ],
    ];
    */
   
    

    //Инициализация парсера
    //URL - для которого нужно подобрать и инициализировать соответствующий парсер
    //contentPath - путь к уже загруженному HTML файлу, который нужно отпарсить
    public static function initParser($response)
    {
        $request=$response->request;
        $parserAR=Parser::findByUrl($request->request_url);
        $model=null;
        
        if(isset($parserAR)){
            $model=self::loadParser($parserAR->className);
            $model->parserAR=$parserAR;
            $model->requestAR=$request;
            $model->responseAR=$response;

            return $model; 
        }else{

            //$this->addErrorAR(Error::CODE_PARSER_NOT_FOUND,'Не найден парсер');
            $error=new Error();
            $error->code=Error::CODE_PARSER_NOT_FOUND;
            $error->msg='Не найден парсер';
            
            $error->request_id=$request->id;
            $error->response_id=$response->id;
            $error->save();

            return false; 
        }
    }
    //автозагрузкик парсера по имени класса
    public static function loadParser($parserName)
    {
        $parser=\yii\di\Instance::ensure(
            'common\models\parsers\\' . $parserName
        );

        return $parser;
    }

    //Запуск парсинга
    public function run()
    {
        $content_path=Parser::getClassDir().'contetnt/'.$this->baseClassName.'/';
        if (!file_exists($content_path)) {
            mkdir($content_path, 0777, true);
        }
        $file_name='response_'.$this->responseAR->alias.'.html';
        $contentFullPath=$content_path.$file_name;

        if( (!file_exists($contentFullPath))){
            //если файл еще не загружен или старше 24x часов
            //обновляю файл
            $loader=new HttpLoader();
            $loader->loadContent($this->responseAR->request->request_url,$contentFullPath);
        }

        if($actionName=$this->discoverAction($contentFullPath)){
            return $this->$actionName($this->actionAR);
        }
        
        return false;
    }

    /*
    public function test()
    {
        //$this->testMode=true;

        $path=Parser::getClassDir().'testContetnt/'.$this->baseClassName.'/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        foreach ($this->parserAR->actions as $key => $action) {

            $actionName='action'.$action->name;
            $file=$path.$actionName.'.html';
            //Загрузка контента для тестов
            if( (!file_exists($file)) || (time()-filemtime($file) > 24*3600) ){
                //если файл еще нк загружен или старше 24x часов
                //обновляю файл
                $loader=new HttpLoader();
                $loader->loadContent($action->example_url,$file);
            }

            $content=file_get_contents($file);
            $this->document= phpQuery::newDocument($content);
            

            //Проверка идентификатора действия
            $count=count($this->document->find($action->selector));
            if($count==0){
                $this->addErrorAR(Error::CODE_PARSER_ACTION_NOT_FOUND,'Не найден селектор \''.$action->selector.'\' для действия '.$action->name);
            }

            //Проверка работы парсига (запускаю действие)
            //Если во время выполнения произойдет ошибка, действие зарегистрирует ошубку, но не юудет егот сохранять в БД
            
            $this->$actionName();


        }
        
        if($this->hasErrorsAR){
            return false;
        }else{
            return true;    
        }

    }
    */
    public function testUrl($url,$file_name){

        //Проверяю корректность URL
        
        $content_path=Parser::getClassDir().'contetnt/'.$this->baseClassName.'/';
        if (!file_exists($content_path)) {
            mkdir($content_path, 0777, true);
        }
        $contentFullPath=$content_path.$file_name;

        if( (!file_exists($contentFullPath)) || (time()-filemtime($contentFullPath) > 24*3600) ){
            //если файл еще нк загружен или старше 24x часов
            //обновляю файл
            $loader=new HttpLoader();
            $loader->loadContent($url,$contentFullPath,$this->charset);
        }

        if($actionName=$this->discoverAction($contentFullPath)){
            
            return $this->$actionName($this->actionAR);
        }
        
        return false;
        
        
    }

    public function discoverAction($contentFullPath){
        $actions=[];


        //Если контент загружен
        if(file_exists($contentFullPath)){
            $content=file_get_contents($contentFullPath);


            $this->document= phpQuery::newDocumentHTML($content,$this->charset);
            //определяю тип действия
            foreach ($this->parserAR->actions as $action) {
                $count_results=count($this->document->find($action->selector));
                if($count_results>0){
                    $actions[]=$action;
                }
            }

            if(count($actions)==0){
                //Регистрирую ошибку не найдено действие
                $this->addError('discoverAction',Error::CODE_PARSER_ACTION_NOT_FOUND);
                return false;
            }elseif(count($actions)>1){
                //Регистрирую ошибку найдено несколько действий
                $this->addError('discoverAction',Error::CODE_PARSER_FOUND_MANY_ACTIONS);
                return false;
            }else{
                $this->actionAR=$actions[0];
                $actionName='action'.$this->actionAR->name;
                return $actionName;
            }
        }else{
            //Регистрирую ошибку найдено несколько действий
            $this->addError('discoverAction',Error::CODE_PARSER_CONTENT_NOT_FOUND);
            return false;
        }
    }

    
    //Парсинг страницы
    public function parsPage()
    {
        //парсинг HTML тегов страницы
        return [
            'keywords'=>$this->getKeyWords(),
            'description'=>$this->getDescription(),
        ];


    }

    //Базовые методы, которые наследуют все дочерние парсеры
    public function getKeyWords()
    {
        return $this->document->find('meta[name="keywords"]')->attr('content');
        
    }

    public function getDescription()
    {
        return $this->document->find('meta[name="description"]')->attr('content');
    }

    public function addErrorAR($code)
    {
        $error=new Error();
        $error->code=$code;
        //$error->msg=$msg;
        //$error->description=json_encode($this->errors);
        if(isset($this->parserAR)){
            $error->parser_id=$this->parserAR->id;    
        }
        if(isset($this->requestAR)){
            $error->request_id=$this->requestAR->id;
        }
        if(isset($this->responseAR)){
            $error->response_id=$this->responseAR->id;
        }
        $this->errorsAR[]=$error;
    }

    public function getHasErrorsAR()
    {
        if(count($this->errorsAR)>0){
            return true;
        }
        return false;
    }

    public function saveErrors()
    {
        if($this->hasErrorsAR){
            foreach ($this->errorsAR as $key => $error) {
                $error->save();
            }
            $this->errorsAR=[];
        }
    }

    public function getErrorSummary()
    {
        $summary='';
        if($this->hasErrorsAR){
            foreach ($this->errorsAR as $key => $error) {
                $summary.=$error->getHtmlInfo();
            }
        }
        return $summary;
    }

    public function getJson()
    {
        //Возращает в JSON формате поля, которые определены
        //в функции fields()
        return json_encode($this->toArray(),JSON_UNESCAPED_UNICODE);
    }


    private $_viewURL;
    public function getViewUrl()
    {
        if(!isset($this->_viewURL)){
            if(isset($this->requestAR)){
                $this->_viewURL=$this->requestAR->request_url;
            }
        }
        return $this->_viewURL;
    }
    public function setViewUrl($value)
    {
        $this->_viewURL=$value;
    }

    public function getBaseClassName()
    {
        $name=get_class($this);
        $nameArray= explode('\\', $name);
        $name=$nameArray[count($nameArray)-1];
        return $name;
    }

    /*
    public function getExportData()
    {
        
        return[
            'id'=>$this->parserAR->id,
            'type_id'=>$this->parserAR->type_id,
            'name'=>$this->parserAR->name,

            'testUrls'=>$this->testUrls,
            'parsActions'=>$this->parsActions,

            'reg_exp'=>$this->parserAR->reg_exp,
            'example_url'=>$this->parserAR->example_url,
        ];
    }

    */


    
    

}
