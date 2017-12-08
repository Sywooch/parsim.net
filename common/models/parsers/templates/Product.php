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
    public $testUrls=[
        'actionParsList'=>'{actionParsList}',
        'actionParsItem'=>'{actionParsItem}', 
    ];

    public $parsActions=[
        'actionParsList'=>[
            'itemSelector'=>'{actionParsList_itemSelector}',
            'pagesSelector'=>'{actionParsList_pagesSelector}',
        ],
        'actionParsItem'=>[
            'itemSelector'=>'{actionParsItem_itemSelector}',
        ],
        
    ];
    
    

    //Парсинг списка 
    public function actionParsList()
    {
        
        $data=parent::parsPage();
        $base_url=parse_url($this->testUrls['actionParsList'], PHP_URL_SCHEME).'://'.parse_url($this->testUrls['actionParsList'], PHP_URL_HOST);

        //Парсинг списка
        $items_selector=$this->parsActions['actionParsList']['itemSelector'];
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
            $model->viewUrl=$base_url.pq($item)->find('p a')->attr('href');
            
            $model->price=intval(str_replace(' ', '', pq($item)->find('.prices-wrap-price .price')->text()));
            $model->currency=pq($item)->find('.prices-wrap-price .price span')->text();
            

            if($model->validate()){
                $data['items'][]=$model->toArray();
            }else{
                $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга списка');
                if($this->testMode==false){
                    $this->saveErrors();    
                }
                return false;
            }
        }

        //Парсинг pagination
        $pages_selector=$this->parsActions['actionParsList']['pagesSelector'];
        $pages=$this->document->find($pages_selector);
        foreach ($pages as $key => $item) {
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
                    $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга раздела Pagination');
                    if($this->testMode==false){
                        $this->saveErrors();    
                    }
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

        $item_selector=$this->parsActions['actionParsItem']['itemSelector'];
        $item=$this->document->find($item_selector);

        /*
        {FILL_LIST_ITEM}
        */
        $this->id=pq($item)->find('span[itemprop="productID"]')->text();
        $this->name=$this->document->find('h1[itemprop="name"]')->text();
        $this->price=intval(str_replace(' ', '', pq($item)->find('.caption .price span.h2')->text()));
        $this->currency=pq($item)->find('span[itemprop="priceCurrency"]')->attr('content');
        

        if($this->validate()){
            $data=array_merge($data,$this->toArray());
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $this->addErrorAR(Error::CODE_PARSING_ERROR,'Ошибка парсинга записи');
            if($this->testMode==false){
                $this->saveErrors();    
            }
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
