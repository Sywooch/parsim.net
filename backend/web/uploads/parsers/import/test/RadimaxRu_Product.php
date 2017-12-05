<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserProduct;
use common\models\parsers\classes\ParserPagination;
use common\models\Error;

class RadimaxRu_Product extends ParserProduct
{
    public $parsActions=[
        'actionParsList'=>'div.products_list .product_cart',
        'actionParsItem'=>'#single-product',
    ];
    public $testUrls=[
        'actionParsList'=>'hthttps://www.radimax.ru/brands/retrostyle/',
        'actionParsItem'=>'https://www.radimax.ru/chugunnie_radiatory/retro_style_windsor/350/180.html',
    ];
    

    //Парсинг списка 
    public function actionParsList()
    {
        
        $data=parent::parsPage();
        $base_url=parse_url($this->testUrls['actionParsList'], PHP_URL_SCHEME).'://'.parse_url($this->testUrls['actionParsList'], PHP_URL_HOST);

        //Парсинг списка
        $items_selector=$this->parsActions['actionParsList'];
        $items=$this->document->find($items_selector);
        foreach ($items as $key => $item) {
            $model= new ParserProduct();
            

            /*
            {FILL_ITEM}
            */
            $model->id='N/A';
            $model->name=pq($item)->find('h3.title')->text();
            $model->price=0;
            $model->currency='руб';
            $model->viewUrl=$base_url.pq($item)->find('div.image a')->attr('href');

            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $this->addErrors($model->errors);
                $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                $this->saveErrors();
                return false;
            }
        }

        //Парсинг pagination
        $pages_selector='ul.pagination li';
        $pages=$this->document->find($pages_selector);
        foreach ($pages as $key => $item) {
            $page = new ParserPagination();
            /*
            {FILL_PAGE}
            */
            $page->title=pq($item)->find('a')->text();
            $page->url=$base_url.pq($item)->find('a')->attr('href');

            if($page->validate()){
                $data['pages'][]=$page->toArray();
            }else{
                if(isset($model)){
                    $this->addErrors($page->errors);
                    $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга раздела Pagination');
                    $this->saveErrors();    
                }
                return false;
            }
        }
        return json_encode($data,JSON_UNESCAPED_UNICODE);
        
    }
    
    //Парсинг записи 
    public function actionParsItem()
    {

        $data=parent::parsPage();

        $item_selector=$this->parsActions['actionParsItem'];
        $item=$this->document->find($item_selector);

        /*
        {FILL_LIST_ITEM}
        */
        $this->id='N/A';
        $this->name=pq($item)->find('div[itemprop="name"]')->text();
        $this->price=intval(str_replace(' ', '',  pq($item)->find('span[itemprop="price"]')->text() ));
        $this->currency=pq($item)->find('input[itemprop="priceCurrency"]')->attr('value');
        $this->viewUrl=$this->requestAR->request_url;
        
        if($this->validate()){
            $data=array_merge($data,$this->toArray());
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга записи');
            $this->saveErrors();
            return false;
        }
        
    }

    public function exportToArray()
    {
        $data=[
            'type_id'=>$this->type,
            'name'=>$this->name,
            'status'=>$this->status,
            
            //parsActions selectors
            'listSelector'=>'div.products_list product_cart',
            'itemSelector'=>'#single-product',
            'pagesSelector'=>'ul.pagination li',
            //parsActions selectors
            'listTestUrl'=>'hthttps://www.radimax.ru/brands/retrostyle/',
            'itemTestUrl'=>'https://www.radimax.ru/chugunnie_radiatory/retro_style_windsor/350/180.html',

            'fillItem'=>'',
            'fillListItem'=>'',
            'fillPage'=>'',

            'reg_exp'=>$this->reg_exp,
            'example_url'=>$this->example_url,
        ];

        return $data;
    }

}
