<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\TaskParser;
use common\models\Error;
use common\models\Parser;

class {class_name} extends TaskParser
{
    private $html;
    private $document;
    private $host='{host_name}';
    private $parser;
    
    public function run()
    {
        $this->parser=Parser::findOne('{parser_id}');

        $this->html=str_replace('script', 'script_tag',file_get_contents($this->contentPath));

        //раскомментируй эту строчку, если контент в win-1251
        //$this->html= iconv('cp1251','utf-8', $this->html);

        $this->document=phpQuery::newDocumentHTML($this->html);

        //Определяю тип контента (карточка или список),
        //если определить не удалось, регистрирую ошибку
        if($this->contentType==self::CONTENT_TYPE_LIST){
            return $this->parseList();
        }elseif($this->contentType==self::CONTENT_TYPE_CARD){
            return $this->parseCard();
        }else{
            return $this->regError(Error::CODE_PARSING_ERROR,'Ошибка определения типа контента "списка задач" или "карточка задачи" для хоста '.$this->host);
        }
    }

    ///Определение типа контента
    public function getContentType()
    {
        $list_selector='.enter_here_unic_marker_of_list';
        $card_selector='.enter_here_unic_marker_of_card';

        $count_list=count($this->document->find($list_selector));
        $count_card=count($this->document->find($card_selector));


        if($count_card>0 && $count_list==0){
            return self::CONTENT_TYPE_CARD;
        }

        if($count_list>0 && $count_card==0){
            return self::CONTENT_TYPE_LIST;
        }

        return false;
        
        
    }


    //Парсинг списка
    private function parseList()
    {
        $tasks=[];

        $items_selector='#projects-list .b-post';
        $items=$this->document->find($items_selector);

        foreach ($items as $key => $item) {

            $task= new TaskParser();

            
            $task->setId( pq($item)->find('')->text() );
            $task->setName( pq($item)->find('')->text() );
            

            $task->setPrice(pq($item)->find('')->text() );
            $task->setDescription( pq($item)->find('')->text() );
            
            
            $task->setViewUrl( 'https://www.________.ru'.pq($item)->find('')->text() );

            
            $task->setType( pq($item)->find('')->text() );
            $task->setDate( pq($item)->find('')->text() );
        
            $task->setViews( pq($item)->find('')->text() );
            $task->setAnswers( pq($item)->find('')->text() );

            
            if($task->validate()){
                $tasks[]=$task->toArray();
            }else{
                $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "списка" для '.$this->host.' '.json_encode($task->errors), json_encode($task->errors));
                return false;
            }
        }

        return json_encode($tasks,JSON_UNESCAPED_UNICODE);
    }
    //Парсинг карточки 
    private function parseCard()
    {
        $item=$this->document->find('');

        $this->setId( pq($item)->find('')->text() );
        $this->setName( pq($item)->find('')->text() );
        

        $this->setPrice(pq($item)->find('')->text() );
        $this->setDescription( pq($item)->find('')->text() );
        
        $this->setViewUrl( 'https://www.________.ru'.pq($item)->find('')->text() );
        
        $this->setType( pq($item)->find('')->text() );
        $this->setDate( pq($item)->find('')->text() );
    
        $this->setViews( pq($item)->find('')->text() );
        $this->setAnswers( pq($item)->find('')->text() );

        if($this->validate()){
            return $this->json;
        }else{
            $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "карточки" для '.$this->host.' '.json_encode($this->errors), json_encode($task->errors));
            return false;
        }
        
        
    }

    private function regError($code,$msg,$description=null){
        $error=new Error();

        $error->code=$code;
        $error->msg=$msg;
        $error->description=$description;
        $error->status=Error::STATUS_NEW;
        $error->parser_id=$this->parser->id;

        $error->save();
    }


}
