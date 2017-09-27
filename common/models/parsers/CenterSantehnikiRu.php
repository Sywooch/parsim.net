<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;


class CenterSantehnikiRu extends ProductParser
{
    
    
    
    public function run()
    {
        $action=$this->getAction();
        return $this->$action;
    }

    public function getAction()
    {
        
        return $this->defaultAction;
    }

    //Parser actions
    public function getProductCard()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);
        
        $price=phpQuery::newDocumentHTML($document->find('span.product-price-item')->html());

        $currency=$price->find('span');
        $price->find('span')->remove();
        $price->find('.old-price.item_old_price')->remove();

        $this->id='';
        $this->name=$document->find('h1.page-gray-title')->text();
        $this->price=trim(preg_replace('/\s+/', '', $price->text()));
        $this->currency=$document->find('span.product-price-item span')->text();


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
