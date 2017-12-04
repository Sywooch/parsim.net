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
    public $parsActions=[
        'actionParsList'=>'{LIST_SELECTOR}',
        'actionParsItem'=>'{ITEM_SELECTOR}',
    ];
    public $testUrls=[
        'actionParsList'=>'{LIST_TEST_URL}',
        'actionParsItem'=>'{ITEM_TEST_URL}',
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

            /*
            {FILL_ITEM}
            */
            $model->id=pq($item)->find('.compare-button')->attr('data-id');
            $model->name=pq($item)->find('p a')->text();
            $model->price=intval(str_replace(' ', '', pq($item)->find('.prices-wrap-price .price')->text()));
            $model->currency=pq($item)->find('.prices-wrap-price .price span')->text();
            $model->viewUrl=parse_url($this->testUrls['actionParsList'], PHP_URL_SCHEME).'://'.parse_url($this->testUrls['actionParsList'], PHP_URL_HOST).pq($item)->find('p a')->attr('href');

            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                $model->saveErrors();
                return false;
            }
        }

        //Парсинг pagination
        $pages_selector='{PAGES_SELECTOR}';
        $pages=$this->document->find($pages_selector);
        foreach ($pages as $key => $page) {
            $page = new ParserPagination();

            /*
            {FILL_PAGE}
            */
            $page = new ParserPagination();
            $page->title=pq($item)->find('a')->text();
            $page->url=pq($item)->find('a')->attr('href');
            
            if($page->validate()){
                $data['pages'][]=$page->toArray();
            }else{
                if(isset($model)){
                    $model->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга раздела Pagination');
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

        $data=parent::parsPage();

        $item_selector=$this->parsActions['actionParsItem'];
        $item=$this->document->find($item_selector);

        /*
        {FILL_LIST_ITEM}
        */
        $this->id=pq($item)->find('span[itemprop="productID"]')->text();
        $this->name=$this->document->find('h1[itemprop="name"]')->text();
        $this->price=pq($item)->find('span[itemprop="price"]')->text();
        $this->currency=pq($item)->find('span[itemprop="priceCurrency"]')->attr('content');
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
            'listSelector'=>'{LIST_SELECTOR}',
            'itemSelector'=>'{ITEM_SELECTOR}',
            'pagesSelector'=>'{PAGES_SELECTOR}',
            //parsActions selectors
            'listTestUrl'=>'{LIST_TEST_URL}',
            'itemTestUrl'=>'{ITEM_TEST_URL}',

            'fillItem'=>'',
            'fillListItem'=>'',
            'fillPage'=>'',

            'reg_exp'=>$this->reg_exp,
            'example_url'=>$this->example_url,
        ];

        return $data;
    }

}
