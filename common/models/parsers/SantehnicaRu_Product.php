<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;
use common\models\Error;
use common\models\Parser;

class SantehnicaRu_Product extends ProductParser
{
    private $html;
    private $document;
    private $host='santehnica.ru';
    private $parser;
    
    public function run()
    {
        $this->parser=Parser::findOne('17');

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
        $list_selector='.template-product-list';
        $card_selector='.prod-wrap';

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
        $products=[];

        $items_selector='div.template-product-list .row .col-md-4';

        $items=$this->document->find($items_selector);
        foreach ($items as $key => $item) {
            $product= new ProductParser();

            $product->setId( pq($item)->find('div[type="lis-comments-external"]')->attr('data-id') );
            $product->setName( pq($item)->find('div[type="lis-comments-external"]')->attr('data-title') );
            $product->setPrice( str_replace(' ', '', pq($item)->find('div.price span.h2.text-warning')->text()) );
            $product->setCurrency(pq($item)->find('div.price span.h4.text-muted')->text());

            if($product->validate()){
                $products[]=$product->toArray();
            }else{
                //$this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "списка товаров" для '.$this->host, json_encode($product->errors));
                return false;
            }
        }

        return json_encode($products,JSON_UNESCAPED_UNICODE);
    }
    //Парсинг карточки товаров
    private function parseCard()
    {
        
        $this->setId($this->document->find('span[lis-action="lisShowRating"]')->attr('lis-data-id'));
        $this->setName($this->document->find('h1[itemprop="name"]')->text());
        $this->setPrice($this->document->find('span[itemprop="price"]')->attr('content'));
        $this->setCurrency($this->document->find('span[itemprop="priceCurrency"]')->attr('content'));

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