<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;
use common\models\Error;
use common\models\Parser;

class SportmasterRu_Product extends ProductParser
{
    private $html;
    private $document;
    private $host='sportmaster.ru';
    private $parser;
    
    public function run()
    {
        $this->parser=Parser::findOne('57');

        $this->html=file_get_contents($this->contentPath);

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
            return $this->regError(Error::CODE_PARSING_ERROR,'Ошибка определения типа контента "списка товаров" или "карточка товара" для хоста '.$this->host);
        }
    }

    ///Определение типа контента
    public function getContentType()
    {
        $card_selector='.sm-goods_main_details';
        $list_selector='#categoryItemContainer';
        

        $count_card=count($this->document->find($card_selector));
        $count_list=count($this->document->find($list_selector));
        


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
        $products=[];

        $items_selector='#categoryItemContainer .sm-category__item';

        $items=$this->document->find($items_selector);
        foreach ($items as $key => $item) {
            $product= new ProductParser();

            $product->setId( pq($item)->find('span.js-compare-link')->attr('data-id') );
            $product->setName( pq($item)->find('h2 a')->attr('title') );
            $product->setPrice( str_replace('value: ', '', pq($item)->find('.sm-category__item-actual-price sm-amount')->attr('params')) );
            $product->setCurrency('RUB');

            if($product->validate()){
                $products[]=$product->toArray();
            }else{
                $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "списка товаров" для '.$this->host.' '.json_encode($product->errors), json_encode($product->errors));
                return false;
            }
        }

        return json_encode($products,JSON_UNESCAPED_UNICODE);
    }
    //Парсинг карточки товаров
    private function parseCard()
    {
        
        $this->setId($this->document->find('span.js-compare-link')->attr('data-id'));
        $this->setName($this->document->find('.sm-goods_main_details h1')->text());
        $this->setPrice($this->document->find('meta[itemprop="price"]')->attr('content') );
        $this->setCurrency('RUB');

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
