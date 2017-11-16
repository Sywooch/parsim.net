<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;

class WodoleiRu_ProductCard extends ProductParser
{
    
    
    public function run()
    {
        $html=file_get_contents($this->contentPath);
        $html= iconv('cp1251','utf-8', $html);
        $document=phpQuery::newDocumentHTML($html);

       
        $this->setId($document->find('td[itemprop="productID"]')->text());
        $this->setName($document->find('h1[itemprop="name"]')->text());
        $this->setPrice(trim(preg_replace('/\D+/', '', $document->find('span[itemprop="price"]')->text())));
        
        $this->setCurrency($document->find('span[itemprop="priceCurrency"]')->attr('content'));

        return $this->json;
    }


}
