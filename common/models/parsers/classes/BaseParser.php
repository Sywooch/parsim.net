<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;

use common\models\parsers\classes\HttpLoader; //загрузчик контента
use \phpQuery; //Parser HTNL


use common\models\Parser;
use common\models\Error;

class BaseParser extends Model
{
    //const FORMAT_JSON = 0;
    //const FORMAT_XML = 1;
    
    //const CONTENT_TYPE_LIST = 1;
    //const CONTENT_TYPE_CARD = 2;
    
    //public $url;


    public $parserAR;
    public $requestAR;
    public $responseAR;
    public $document;

    public $errorsAR=[];

    public $testMode=false;

    public $result=[];

    public $testUrls=[
        'actionParsList'=>'', //в классе наследнике указывается эталонный URL, по которому проверяется корректность работы действия - парсинг списка
        'actionParsItem'=>'', //в классе наследнике указывается эталонный URL, по которому проверяется корректность работы действия - парсинг записи
    ];

    public $parsActions=[
        'actionParsList'=>[
            'itemSelector'=>'',
            'pagesSelector'=>'',
        ],
        'actionParsItem'=>[
            'itemSelector'=>'',
        ],
        
    ];
   
    

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
        $action=$this->discoverAction();
        if($action){
            //Если действие определено его на выполнение
            return $this->$action();
        }else{
            return false;
        }
    }

    public function test()
    {
        $this->testMode=true;

        //$this->errorsAR=[];
        //$path=Yii::getAlias('@console/data/htmlContent/forTests/'.$this->baseClassName.'/');
        $path=Parser::getClassDir().'testContetnt/'.$this->baseClassName.'/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        foreach ($this->parsActions as $action => $selector) {

            
            //Проверка наличия тестовых URL
            $url=$this->testUrls[$action];
            if(!filter_var($url, FILTER_VALIDATE_URL)){
                $this->addErrorAR(Error::CODE_UNSET_URL,'Не задан URL для действия '.$action);
                continue;
            }

            $file=$path.$action.'.html';
            //Загрузка контента для тестов
            if( (!file_exists($file)) || (time()-filemtime($file) > 24*3600) ){
                //если файл еще нк загружен или старше 24x часов
                //обновляю файл
                $loader=new HttpLoader();
                $loader->loadContent($url,$file);
            }

            if(!isset($selector['itemSelector']) || $selector['itemSelector']==''){
                $this->addErrorAR(Error::CODE_UNSET_SELECTOR,'Не задан селектор для действия '.$action);
                continue;
            }
            

            $content=file_get_contents($file);
            $this->document= phpQuery::newDocument($content);
            

            //Проверка работы селектора для действия
            $count=count($this->document->find($selector['itemSelector']));
            if($count==0){
                $this->addErrorAR(Error::CODE_PARSER_ACTION_NOT_FOUND,'Не найден селектор \'itemSelector\' для действия '.$action);
            }

            //Проверка работы парсига (запускаю действие)
            //Если во время выполнения произойдет ошибка, действие зарегистрирует ошубку, но не юудет егот сохранять в БД
            $this->$action();


        }
        
        if($this->hasErrorsAR){
            return false;
        }else{
            return true;    
        }

    }

    public function discoverAction(){
        $actions=[];

        //Если контент загружен
        if(file_exists($this->responseAR->contentPath)){

            $this->document= phpQuery::newDocumentHTML(file_get_contents($this->responseAR->contentPath));
            //определяю тип действия
            foreach ($this->parsActions as $action => $selector) {
                $count_results=count($this->document->find($selector));
                if($count_results>0){
                    $actions[]=$action;
                }
            }

            if(count($actions)==0){
                //Регистрирую ошибку не найдено действие
                $this->addErrorAR(Error::CODE_PARSER_ACTION_NOT_FOUND,'Дейcтвие не определено');
                return false;
            }elseif(count($actions)>1){
                //Регистрирую ошибку найдено несколько действий
                $this->addErrorAR(Error::CODE_PARSER_FOUND_MANY_ACTIONS,'Найдено более одного дейcтвия');
                return false;
            }else{
                return $actions[0];
            }
        }else{
            //Регистрирую ошибку найдено несколько действий
            $this->addErrorAR(Error::CODE_PARSER_CONTENT_NOT_FOUND,'Не найден файл с контентом');
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

    public function addErrorAR($code,$msg)
    {
        $error=new Error();
        $error->code=$code;
        $error->msg=$msg;
        $error->description=json_encode($this->errors);
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

    
    

}
