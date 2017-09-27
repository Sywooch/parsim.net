<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;


class SantehnikaOnlineRu extends ProductParser
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
        
        $this->id=$document->find('span.property_value noindex')->text();
        $this->name=$document->find('h1[itemprop="name"]')->text();
        $this->price=trim(preg_replace('/\s+/', '', $document->find('div.newprice')->attr('data-price')));
        $this->currency=$document->find('div.newprice span')->text();

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
