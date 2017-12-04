<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;
use common\models\Error;
use common\models\Parser;

class OboiInfo_Product extends ProductParser
{
    private $html;
    private $document;
    private $host='oboi.info';
    private $parser;
    
    public function run()
    {
        $this->parser=Parser::findOne('60');

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
            return $this->regError(Error::CODE_PARSING_ERROR,'Ошибка определения типа контента "списка товаров" или "карточка товара" для хоста '.$this->host);
        }
    }

    ///Определение типа контента
    public function getContentType()
    {
        $list_selector='.product-catalog .product-catalog-item';
        $card_selector='.product-portrait .description';

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
        $products=[];
        $items_selector='.product-catalog .product-catalog-item';
        $items=$this->document->find($items_selector);

        foreach ($items as $key => $item) {
            $product= new ProductParser();

            $product->setId( pq($item)->find('.name span')->text() );
            $product->setName( pq($item)->find('.name span')->text().'('.pq($item)->find('.article')->text().')' );
            $product->setPrice( intval(str_replace(' ', '', pq($item)->find('.price .amount')->text())) );
            $product->setCurrency(str_replace(' ', '', pq($item)->find('.price')->text()) );
            $product->setViewUrl( 'http://www.oboi.info'.pq($item)->find('.name a')->attr('href') );

            if($product->validate()){
                $products[]=$product->toArray();
            }else{
                $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "списка" для '.$this->host.' '.json_encode($product->errors), json_encode($product->errors));
                return false;
            }
        }
        return json_encode($products,JSON_UNESCAPED_UNICODE);
    }
    
    //Парсинг карточки 
    private function parseCard()
    {
        $item=$this->document->find('product-portrait.cl');

        $this->setId( pq($item)->attr('data-item_id') );
        $this->setName( $this->document->find('h1.page-title')->text() );
        $this->setPrice( pq($item)->find('.price .number')->text() );
        $this->setCurrency( pq($item)->find('.price')->text() );

        if($this->validate()){
            return $this->json;
        }else{
            $this->regError(Error::CODE_PARSING_ERROR,'Ошибка парсинга "карточки" для '.$this->host.' '.json_encode($product->errors), json_encode($this->errors));
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
