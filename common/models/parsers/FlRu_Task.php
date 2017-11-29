<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\TaskParser;
use common\models\Error;
use common\models\Parser;

class FlRu_Task extends TaskParser
{
    private $html;
    private $document;
    private $host='fl.ru';
    private $parser;
    
    public function run()
    {

        

        $this->parser=Parser::findOne('58');
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
        $list_selector='#projects-list';
        $card_selector='.main h1.b-page__title.b-page__title_ellipsis';

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

    //Парсинг списка товаров
    private function parseList()
    {
        $tasks=[];

        

        $items_selector='#projects-list .b-post';

        $items=$this->document->find($items_selector);

        foreach ($items as $key => $item) {

            $task= new TaskParser();

            
            $task->setId( str_replace('project-item', '', pq($item)->attr('id')) );
            $task->setName( pq($item)->find('h2 a.b-post__link')->text() );
            

            $task->setPrice( pq($item)->find('.b-post__price')->text() );
            $task->setDescription( pq($item)->find('div.b-post__body div.b-post__txt')->text() );
            
            
            $task->setViewUrl( 'https://www.fl.ru'.pq($item)->find('h2 a')->attr('href') );

            
            $task->setType( pq($item)->find('span.b-post__bold.b-layout__txt_inline-block')->text() );
            $task->setDate( pq($item)->find('span.b-post__txt.b-post__txt_fontsize_11.b-post__txt_overflow_hidden')->text() );
        
            $task->setViews( preg_replace('/\s\s+/', ' ', pq($item)->find('span.b-post__txt.b-post__txt_float_right.b-post__txt_fontsize_11.b-post__txt_bold.b-post__link_margtop_7')->text()) );
            $task->setAnswers( pq($item)->find('a.b-post__link.b-post__txt_float_right.b-post__link_bold.b-post__link_fontsize_11.b-post__link_color_4e.b-post__link_color_0f71c8_hover.b-post__link_margtop_7.b-page__desktop')->text() );

            
            if($task->validate()){
                $tasks[]=$task->toArray();
            }else{
                $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "списка задач" для '.$this->host.' '.json_encode($task->errors), json_encode($task->errors));
                return false;
            }
        }

        return json_encode($tasks,JSON_UNESCAPED_UNICODE);
    }
    //Парсинг карточки товаров
    private function parseCard()
    {

        //$item=$this->document->find($items_selector);
        
        $this->setId( $this->document->find('h1.b-page__title')->attr('id') );
        $this->setName( $this->document->find('h1.b-page__title')->text() );
        
        //$task->setPrice( $this->document->find('h1.b-page__title')->text() );

        if($this->validate()){
            return $this->json;
        }else{
            //$this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "карточки товаров" для '.$this->host, json_encode($this->errors));
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
