<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\Parser;

class AquadomRu extends ProductParser
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

        $price=phpQuery::newDocumentHTML($document->find('.table-product1 span.price')->html());

        $currency=$price->find('span.currency')->text();
        $price->find('span.currency')->remove();
        

       
        $this->setId('n/a');
        $this->setName($document->find('.product-info2 h1')->text());
        $this->setPrice(trim(preg_replace('/\s+/', '', $price->text())));
        $this->setCurrency($currency);

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
