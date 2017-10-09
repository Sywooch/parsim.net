<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\Parser;

class DushevoiRu extends ProductParser
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
       
        $this->setId($document->find('span[itemprop="productID"]')->text());
        $this->setName($document->find('h1[itemprop="name"]')->text());
        $this->setPrice($document->find('span[itemprop="price"]')->text());
        $this->setCurrency($document->find('span[itemprop="priceCurrency"]')->attr('content'));

        return $this->json;
    }

    public function getProductList()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);

        $this->id=0;
        $this->name='';
        $this->price=0;
        $this->currency='';

        return $this->json;
    }

}
