<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;
use \phpQuery;

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

    public $result=[];

    public $parsActions=[
        'actionParsList'=>'',//в классе наследнике, указывается jQuery selectot, который однозначно идентифицирует действие - парсинг списка
        'actionParsItem'=>'',//в классе наследнике, указывается jQuery selectot, который однозначно идентифицирует действие - парсинг записи
    ];
    public $testUrls=[
        'actionParsList'=>'', //в классе наследнике указывается эталонный URL, по которому проверяется корректность работы действия - парсинг списка
        'actionParsItem'=>'', //в классе наследнике указывается эталонный URL, по которому проверяется корректность работы действия - парсинг записи
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
    private static function loadParser($parserName)
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

    //Тестирование парсера, прогон по всем эталонным URL
    public function test()
    {

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

    public function getJson()
    {
        //Возращает в JSON формате поля, которые определены
        //в функции fields()
        return json_encode($this->toArray(),JSON_UNESCAPED_UNICODE);
    }
    

}
