<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserProduct;
use common\models\parsers\classes\ParserPagination;
use common\models\Error;

class {CLASS_NAME} extends ParserProduct
{

    //Парсинг списка 
    public function actionParsList($action)
    {
        
        $data=parent::parsPage();
        $base_url=parse_url($action->example_url, PHP_URL_SCHEME).'://'.parse_url($action->example_url, PHP_URL_HOST);
        
        //$model->priceCanZero=true;

        //Парсинг списка
        $items=$this->document->find('{set_here_correct_selector}');
        foreach ($items as $key => $item) {
            $model= new ParserProduct();
            
            // --- Begin of parse item
            $model->id='N/A';
            $model->name=pq($item)->find('p a')->text();
            $model->viewUrl=$base_url.pq($item)->find('p a')->attr('href');
            $model->price=intval( preg_replace('/[a-zA-Zа-яА-Я\s]+/u', '', pq($item)->find('.brief_price_line .product_price')->text()) );
            $model->currency=preg_replace('/^[0-9\s+]/', '',pq($item)->find('meta[itemprop="priceCurrency"]')->attr('content') );
            // --- End of parse item
            

            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $this->addError('actionParsList',Error::CODE_PARSING_ERROR);
                $this->addErrors($model->errors);

                //$this->addError('name',pq($item)->find('.new_catalog2 div a')->text() );

                return false;
            }
        }

        //Парсинг pagination
        $pages_selector='ul.pagination li';
        $pages=$this->document->find($pages_selector);
        foreach ($pages as $key => $item) {
            
            // --- Begin of parse page
            $page = new ParserPagination();
            $page->title=pq($item)->find('a')->text();
            $page->url=$base_url.pq($item)->find('a')->attr('href');
            // --- End of parse page
            
            if($page->validate()){
                $data['pages'][]=$page->toArray();
            }else{
                $this->addError('actionParsList',Error::CODE_PARSING_ERROR);
                return false;
            }
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
        
    }
    
    //Парсинг записи 
    public function actionParsItem($action)
    {

        $data=parent::parsPage();

        $item=$this->document->find('{set_here_correct_selector}');
        
        // --- Begin of parse item
        $this->id='N/A';
        $this->name=$this->document->find('h1[itemprop="name"]')->text();
        $this->price=intval(preg_replace('/[^\w_]+/u', '',pq($item)->find('.caption .price span.h2')->text()) );
        $this->currency=preg_replace('/^[0-9\s+]/', '',pq($item)->find('span[itemprop="priceCurrency"]')->attr('content') );
        // --- End of parse item

        if($this->validate()){
            $data=array_merge($data,$this->toArray());
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $this->addError('actionParsItem',Error::CODE_PARSING_ERROR);
            return false;
        }
        
    }


}
