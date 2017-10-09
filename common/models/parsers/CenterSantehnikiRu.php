<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;
use common\models\Parser;

class CenterSantehnikiRu extends ProductParser
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
        
        $price=phpQuery::newDocumentHTML($document->find('span.product-price-item')->html());

        $currency=$price->find('span')->text();
        $price->find('span')->remove();
        $price->find('.old-price.item_old_price')->remove();

        $this->setId('n/a');
        $this->setName($document->find('h1.page-gray-title')->text());
        $this->setPrice(trim(preg_replace('/\s+/', '', $price->text())));

        $this->setCurrency($currency);
        //$this->setCurrency('руб.');

        

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
