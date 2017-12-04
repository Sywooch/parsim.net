<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ProductParser;

class CenterSantehnikiRu_ProductCard extends ProductParser
{
    
    
    public function run()
    {
        $html=file_get_contents($this->contentPath);
        $document=phpQuery::newDocumentHTML($html);

        $this->setId($document->find('span.property_value noindex')->text());
        $this->setName($document->find('h1[itemprop="name"]')->text());
        $this->setPrice(trim(preg_replace('/\s+/', '', $document->find('div.newprice')->attr('data-price'))));
        $this->setCurrency($document->find('meta[itemprop="priceCurrency"]')->attr('content'));

        return $this->json;
    }


}
