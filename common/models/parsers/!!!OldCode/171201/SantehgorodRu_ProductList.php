<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;

class SantehgorodRu_ProductList extends ProductParser
{
    
    
    public function run()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);
       
        $this->setId($document->find('span[itemprop="productID"]')->text());
        $this->setName($document->find('h1[itemprop="name"]')->text());
        $this->setPrice($document->find('span[itemprop="price"]')->text());
        $this->setCurrency($document->find('span[itemprop="priceCurrency"]')->attr('content'));

        return $this->json;
    }


}
