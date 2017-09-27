<?php

namespace common\models\parsers;

use Yii;
use \phpQuery;


class DushevoiRu extends ProductParser
{
    
    
    public function run()
    {
        $action=$this->getAction();
        return $this->$action;
    }

    public function getAction()
    {
        
        //=================================================================================
        //
        // Примеры Url, признак товара суфикс '-ware'
        //
        //=================================================================================
        //Product
        //https://www.dushevoi.ru/products/dushevaya-kabina-niagara-ng-2310-r-111152-ware/

        //Product list
        //https://www.dushevoi.ru/products/dushevye-kabiny/
        //https://www.dushevoi.ru/products/


        $path=parse_url($this->url, PHP_URL_PATH);
        $listPattern="/\bproducts\b/i";
        $prodPattern='/(\bproducts\b)?(\b-ware\b)/i';

        if(preg_match($listPattern,$path)){
            $this->defaultAction='productList';
        }

        if(preg_match($prodPattern,$path)){
            $this->defaultAction='productCard';
        }

        return $this->defaultAction;
    }

    //Parser actions
    public function getProductCard()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);
       
        $this->id=$document->find('span[itemprop="productID"]')->text();
        $this->name=$document->find('h1[itemprop="name"]')->text();
        $this->price=$document->find('span[itemprop="price"]')->text();
        $this->currency=$document->find('span[itemprop="priceCurrency"]')->attr('content');

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
