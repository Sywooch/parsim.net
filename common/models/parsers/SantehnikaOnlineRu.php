<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;
use common\models\Parser;


class SantehnikaOnlineRu extends ProductParser
{
    
    public function run()
    {
        $action=$this->getAction();
        return $this->$action;
    }

    //Parser actions
    public function getProductCard()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);

        $this->setId($document->find('span.property_value noindex')->text());
        $this->setName($document->find('h1[itemprop="name"]')->text());
        $this->setPrice(trim(preg_replace('/\s+/', '', $document->find('div.newprice')->attr('data-price'))));
        $this->setCurrency($document->find('meta[itemprop="priceCurrency"]')->attr('content'));

        return $this->json;

    }

    public function getProductList()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);

        $this->id=null;
        $this->name=null;
        $this->price=null;
        $this->currency=null;

        return $this->json;
    }

}
