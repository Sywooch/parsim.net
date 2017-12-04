<?php
//Парсинг карточки товара
namespace common\models\parsers;

use Yii;
use \phpQuery;

use common\models\parsers\classes\ParserProduct;
use common\models\parsers\classes\ParserPagination;
use common\models\Error;

class DushevoiRu_Product extends ParserProduct
{
    public $parsActions=[
        'actionParsList'=>'div.goods div.good-item',
        'actionParsItem'=>'#item-price-wrap',
    ];
    public $testUrls=[
        'actionParsList'=>'https://www.dushevoi.ru/products/dushevye-kabiny/',
        'actionParsItem'=>'https://mytishi.dushevoi.ru/products/dushevaya-kabina-eago-dz949f6-49915-ware/',
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
            $model->parserAR=$this->parserAR;
            $model->requestAR=$this->requestAR;
            $model->responseAR=$this->responseAR;


            $model->id=pq($item)->find('.compare-button')->attr('data-id');
            $model->name=pq($item)->find('p a')->text();
            $model->price=intval(str_replace(' ', '', pq($item)->find('.prices-wrap-price .price')->text()));
            $model->currency=pq($item)->find('.prices-wrap-price .price span')->text();
            $model->viewUrl=$base_url.pq($item)->find('p a')->attr('href');

            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                $model->saveErrors();
                return false;
            }
        }

        //Парсинг pagination
        
        $pages_selector='ul.pagination li';
        $pages=$this->document->find($pages_selector);
        foreach ($pages as $key => $item) {
            $page = new ParserPagination();
            $page->title=pq($item)->find('a')->text();
            $page->url=$base_url.pq($item)->find('a')->attr('href');

            if($page->validate()){
                $data['pages'][]=$page->toArray();
            }else{
                if(isset($model)){
                    $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга раздела Pagination');
                    //$model->addErrors($page->errors);
                    $model->saveErrors();    
                }
                
                return false;
            }
        }
        
        return json_encode($data,JSON_UNESCAPED_UNICODE);
        
    }
    
    //Парсинг записи 
    public function actionParsItem()
    {

        //load keywords and description
        $data=parent::parsPage();

        $data['items']=[];
        $data['pages']=null;

        $item_selector=$this->parsActions['actionParsItem'];
        $item=$this->document->find($item_selector);

        $this->id=pq($item)->find('span[itemprop="productID"]')->text();
        $this->name=$this->document->find('h1[itemprop="name"]')->text();
        $this->price=pq($item)->find('span[itemprop="price"]')->text();
        $this->currency=pq($item)->find('span[itemprop="priceCurrency"]')->attr('content');
        $this->viewUrl=$this->requestAR->request_url;

        if($this->validate()){
            //$data=array_merge($data,['items'=>$this->toArray()],['pages'=>null]);
            $data['items'][]=$this->toArray();
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
            'listSelector'=>'.row.goods',
            'itemSelector'=>'#item-price-wrap',
            'pagesSelector'=>'ul.pagination li a',
            //parsActions selectors
            'listTestUrl'=>'https://www.dushevoi.ru/products/dushevye-kabiny/',
            'itemTestUrl'=>'https://mytishi.dushevoi.ru/products/dushevaya-kabina-eago-dz949f6-49915-ware/',

            'fillItem'=>'',
            'fillListItem'=>'',
            'fillPage'=>'',

            'reg_exp'=>$this->reg_exp,
            'example_url'=>$this->example_url,
        ];

        return $data;
    }

}
