<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;
use common\models\Error;
use common\models\Parser;

class {class_name} extends AccountParser
{
    private $html;
    private $document;
    private $host='{host_name}';
    private $parser;
    
    public function run()
    {
        $this->parser=Parser::findOne('{parser_id}');

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

        $items_selector='';
        $id_selector='';
        $name_selector='';
        $price_selector='';
        $currency_selector='';

        $items=$this->document->find($items_selector);
        foreach ($items as $key => $item) {
            $product= new ProductParser();

            $product->setId(pq($item)->find($id_selector));
            $product->setName(pq($item)->find($name_selector));
            $product->setPrice(pq($item)->find($price_selector));
            $product->setCurrency(pq($item)->find($currency_selector));

            if($product->validate()){
                $products[]=$product;
            }else{
                $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "списка товаров" для '.$this->host, json_encode($product->errors));
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
        
        return $this->json;
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
